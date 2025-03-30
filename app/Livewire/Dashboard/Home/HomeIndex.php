<?php

namespace App\Livewire\Dashboard\Home;

use App\Exports\EmployeePayroll;
use App\Models\EmployeeMaster;
use App\Models\Vendor;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class HomeIndex extends Component
{
    use WithPagination;

    #[Url(as: 'q', except: '')]
    public $employees = [];
    public $search = '';
    public $selectedVendor = '';
    public $month = '';
    public $year = '';

    public string $client = '';
    public string $status = '';
    public string $selectedMonthYear = '';
    public $monthView = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        // Set the default value for monthView as the current month
        $this->monthView = Carbon::now()->format('Y-m');
        // The selectedMonthYear will only be updated based on the input from the user.
        $this->selectedMonthYear = $this->monthView;
    }

    public function updatedMonthView($value)
    {
        $this->selectedMonthYear = Carbon::parse($value)->format('Y-m');
        $this->resetPage(); // Reset pagination when the filter changes
    }

    public function render()
    {
        // dd($this->selectedMonthYear);
        $employMaster = EmployeeMaster::with([
        'area', 
        'vendors', 
        'absent',
        'clean',
        'bbm', 
        'sla',  
        'insentif', 
        'lainya', 
        'lembur', 
        'cut', 
        'makan', 
        'stand',
        'previous', 
        'retribution',
        'bpjs'
        ])
        ->when($this->search !== '', fn (Builder $query) => $query->where('name', 'like', '%'. $this->search .'%'))
        ->when($this->client !== '', fn (Builder $query) => $query->where('client', $this->client))
        ->when($this->status !== '', fn (Builder $query) => $query->where('status', $this->status))
        ->when($this->selectedVendor !== '', fn (Builder $query) => 
            $query->whereHas('vendors', fn ($q) => $q->where('vendor_id', $this->selectedVendor))
        )
        ->when($this->selectedMonthYear !== '', function (Builder $query) {
            $query->where(function ($q) {
                foreach ([
                    'absent', 'clean', 'bbm', 'sla', 'insentif', 'lainya',
                    'lembur', 'cut', 'makan', 'stand', 'previous', 'retribution'
                ] as $relation) {
                    $q->orWhereHas($relation, fn ($subQuery) => 
                        $subQuery->where('month_year', 'like', Carbon::parse($this->selectedMonthYear)->format('Y-m') . '%')
                    );
                }
            });
        })
       ->paginate(60);
        $data = [
            'employMaster' => $employMaster,
            'vendors' => Vendor::pluck('name', 'id'),
        ];
        return view('livewire.dashboard.home.home-index', $data)->layout('layouts.dashboard', [
            'header' => 'Home'
        ]);
    }

    public function export()
    {
        $date = now()->format('Y-m-d');
        $fileName = 'employee-payroll-' . $date . '.xlsx';
    
        // Ambil data berdasarkan query dengan filter yang sudah ditentukan
        $employMasterQuery = EmployeeMaster::with([
            'area', 
            'vendors', 
            'absent',
            'clean',
            'bbm', 
            'sla',  
            'insentif', 
            'lainya', 
            'lembur', 
            'cut', 
            'makan', 
            'stand',
            'previous', 
            'retribution',
            'bpjs'
        ])
        ->when($this->search !== '', fn (Builder $query) => $query->where('name', 'like', '%'. $this->search .'%'))
        ->when($this->client !== '', fn (Builder $query) => $query->where('client', $this->client))
        ->when($this->status !== '', fn (Builder $query) => $query->where('status', $this->status))
        ->when($this->selectedVendor !== '', fn (Builder $query) => 
            $query->whereHas('vendors', fn ($q) => $q->where('vendor_id', $this->selectedVendor))
        )
        ->when($this->selectedMonthYear !== '', function (Builder $query) {
            $query->where(function ($q) {
                foreach ([
                    'absent', 'clean', 'bbm', 'sla', 'insentif', 'lainya',
                    'lembur', 'cut', 'makan', 'stand', 'previous', 'retribution'
                ] as $relation) {
                    $q->orWhereHas($relation, fn ($subQuery) => 
                        $subQuery->where('month_year', 'like', Carbon::parse($this->selectedMonthYear)->format('Y-m') . '%')
                    );
                }
            });
        })
        ->get(); // Ambil hasil query
    
        // Jika data kosong, kirimkan respons
        if ($employMasterQuery->isEmpty()) {
            return response()->json(['message' => 'No data found for the given filters.'], 404);
        }
    
        // Kirim data ke class export untuk diunduh
        return Excel::download(new EmployeePayroll($employMasterQuery, $this->selectedMonthYear), $fileName);
    }


}

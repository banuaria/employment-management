<?php

namespace App\Livewire\Dashboard\Cut;

use App\Models\CutSalary;
use App\Models\Vendor;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class CutIndex extends Component
{
    use WithPagination;

    #[Url(as: 'q', except: '')]
    public $month_year = [];
    #[Url(as: 'direction', except: 'asc')]
    public string $sort_direction = 'asc';
    public $search = '';
    public $selectedVendor = '';


    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('listen-alert-confirmation')]
    public function listenAlertConfirmation($do, $id)
    {
        if ($do === 'delete') {
            $this->delete($id);
        }
    }

    public function render()
    {
        $cut = CutSalary::with(['employeeMaster','vendors'])
        ->when($this->selectedVendor !== '', fn (Builder $query) => // Renamed here
            $query->whereHas('vendors', fn ($q) => $q->where('vendor_id', $this->selectedVendor))
        )
        ->when($this->search !== '', fn (Builder $query) => // Renamed here
        $query->whereHas('employeeMaster', fn ($q) => $q->where('name', 'like', '%'. $this->search .'%'))
        )
        ->paginate(10);
        $data = [
            'cut' => $cut,
            'vendors' => Vendor::all(),
        ];

        return view('livewire.dashboard.cut.cut-index', $data)->layout('layouts.dashboard', [
            'header' => 'Cut Salary'
        ]);
    }

    public function export()
    {
        $date = now()->format('Y-m-d'); // Format the date as yyyy-mm-dd
        $fileName = 'uang-pemotongan-employee-' . $date . '.xlsx'; // Append the date to the file name

        // return Excel::download(new AbsentMontly($this->search, $this->client, $this->status, $this->selectedVendor), $fileName);
    }

    public function delete($id)
    {
        $emp = cutsalary::destroy($id);
        if ($emp) {
            $this->dispatch('alert-success', title: 'Employe Successfully Deleted!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Delete Employe');
        }
    }


}

<?php

namespace App\Livewire\Dashboard\Employee;

use App\Exports\EmployeeExport;
use App\Models\EmployeeMaster;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeIndex extends Component
{
    use WithPagination;

    #[Url(as: 'q', except: '')]
    public string $search = '';
    public string $client = '';
    public string $status = '';
    public $selectedVendor = '';
    #[Url(as: 'sort', except: 'created_at')]
    public string $sort_field = 'created_at';
    #[Url(as: 'direction', except: 'asc')]
    public string $sort_direction = 'asc';


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sort_field === $field) {
            $this->sort_direction = $this->sort_direction === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort_field = $field;
            $this->sort_direction = 'desc';
        }
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
        $employMaster = EmployeeMaster::with(['area','vendors'])
        ->when($this->search !== '', fn (Builder $query) => $query->where('name', 'like', '%'. $this->search .'%'))
        ->when($this->client !== '', fn (Builder $query) => $query->where('client', $this->client))
        ->when($this->status !== '', fn (Builder $query) => $query->where('status', $this->status))
        ->when($this->selectedVendor !== '', fn (Builder $query) => // Renamed here
            $query->whereHas('vendors', fn ($q) => $q->where('vendor_id', $this->selectedVendor))
        )
        ->orderBy($this->sort_field, $this->sort_direction)->paginate(10);
        $data = [
            'employMaster' => $employMaster,
            'vendors' => Vendor::all(),
        ];

        return view('livewire.dashboard.employee.employee-index', $data)->layout('layouts.dashboard', [
            'header' => 'employMaster'
        ]);
    }

    public function export()
    {
        $date = now()->format('Y-m-d'); // Format the date as yyyy-mm-dd
        $fileName = 'employees-' . $date . '.xlsx'; // Append the date to the file name

        return Excel::download(new EmployeeExport($this->search, $this->client, $this->status, $this->selectedVendor), $fileName);
    }

    public function delete($id)
    {
        $emp = EmployeeMaster::destroy($id);
        if ($emp) {
            $this->dispatch('alert-success', title: 'Employe Successfully Deleted!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Delete Employe');
        }
    }


}

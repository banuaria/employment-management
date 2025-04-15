<?php

namespace App\Livewire\Dashboard\Employee;

use App\Models\AreaPayroll;
use App\Models\EmployeeMaster;
use App\Models\Vendor;
use Livewire\Attributes\On;
use Livewire\Component;

class EmployeeEdit extends Component
{
    public $employeID;
    public string $client = '';
    public $status;
    public $join_date;
    public $resign_date;
    public $vendor_id;
    public $vendors = [];
    public $nik;
    public string $name = '';
    public int $area_id;
    public $areas = [];

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    #[On('edited')]
    public function edited($id)
    {
        $employeID = EmployeeMaster::find($id);
        $this->employeID  = $employeID;
        $this->client = $employeID->client;
        $this->status  = $employeID->status;
        // vendor
        $this->vendor_id = $employeID->vendor_id;
        $this->vendors = Vendor::pluck('name', 'id')->toArray();      
      
        $this->join_date = $employeID->join_date;
        $this->resign_date = $employeID->resign_date;
        $this->nik = $employeID->nik;
        $this->name  = $employeID->name;
        $this->area_id = $employeID->area_id;
        $this->areas = AreaPayroll::pluck('area', 'id')->toArray();
        $this->dispatch('open-modal', name: 'edit-employee-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.employee.employee-edit');
    }

    public function store()
    {
        $employeID = $this->employeID;

        $validated = $this->validate([
            'name'  => ['required', 'string', 'max:255'],
            'client'  => ['required', 'string', 'max:255'],
            'status'  => ['required', 'string', 'max:255'],
            'join_date'  => ['required', 'date'],
            'resign_date'  => ['nullable', 'date'],
            'nik'  => ['required', 'numeric'],
            'area_id'  => ['required', 'numeric'],
        ]);

        $employeID->update($validated);

        if ($employeID) {
            $this->dispatch('employee-edited');
            $this->dispatch('close-modal', name: 'edit-employee-modal');
            $this->dispatch('alert-success', title: 'Employee Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit Employee');
        }
    }
}

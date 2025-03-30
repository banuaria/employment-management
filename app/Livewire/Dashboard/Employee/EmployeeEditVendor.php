<?php

namespace App\Livewire\Dashboard\Employee;

use App\Models\EmployeeMaster;
use App\Models\Vendor;
use Livewire\Attributes\On;
use Livewire\Component;

class EmployeeEditVendor extends Component
{
    public $employees = [];
    public $vendors = [];
    public $selectedVendors = [];

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    #[On('vendor-edited')]
    public function vendorEdited($id)
    {
        $this->employees = EmployeeMaster::where('id', $id)->get();
        $this->vendors = Vendor::all();

        $this->dispatch('open-modal', name: 'edit-vendor-employee-modal');
    }

    public function toggleVendor($employeeId, $vendorId)
    {
        $employee = EmployeeMaster::find($employeeId);

        if (!$employee) return;

        $success = false;

        if ($employee->vendors()->where('vendor_id', $vendorId)->exists()) {
            $success = $employee->vendors()->detach($vendorId); 
            $this->dispatch('alert-success', title: 'Vendor relationship updated successfully!');
        } else {
            $success = $employee->vendors()->attach($vendorId); 
            $this->dispatch('alert-success', title: 'Vendor relationship updated successfully!');
        }

        // Refresh selected vendors
        $this->selectedVendors[$employeeId] = $employee->vendors()->pluck('vendor_id')->toArray();
    }

    public function render()
    {
        foreach ($this->employees as $employee) {
            $this->selectedVendors[$employee->id] = $employee->vendors()->pluck('vendor_id')->toArray();
        }

        return view('livewire.dashboard.employee.employee-edit-vendor');
    }

}

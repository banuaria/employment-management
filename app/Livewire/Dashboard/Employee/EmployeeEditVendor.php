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

        // Refresh selected vendors
        foreach ($this->employees as $employee) {
            $this->selectedVendors[$employee->id] = $employee->vendors()->pluck('vendor_id')->toArray();
        }

        $this->dispatch('open-modal', name: 'edit-vendor-employee-modal');
    }

    public function toggleVendor($employeeId, $vendorId)
    {
        $employee = EmployeeMaster::find($employeeId);

        if (!$employee) return;

        if ($employee->vendors()->where('vendor_id', $vendorId)->exists()) {
            $employee->vendors()->detach($vendorId);
            $this->dispatch('alert-success', title: 'Vendor relationship removed successfully!');
        } else {
            $employee->vendors()->attach($vendorId);
            $this->dispatch('alert-success', title: 'Vendor relationship added successfully!');
        }

        $this->selectedVendors[$employeeId] = $employee->vendors()->pluck('vendor_id')->toArray();
    }

    public function render()
    {
        // Ensure selected vendors are updated for rendering
        foreach ($this->employees as $employee) {
            $this->selectedVendors[$employee->id] = $employee->vendors()->pluck('vendor_id')->toArray();
        }

        return view('livewire.dashboard.employee.employee-edit-vendor');
    }
}

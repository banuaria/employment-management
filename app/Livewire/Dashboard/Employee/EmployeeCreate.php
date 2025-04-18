<?php

namespace App\Livewire\Dashboard\Employee;

use App\Models\AreaPayroll;
use App\Models\EmployeeMaster;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class EmployeeCreate extends Component
{
    public string $client = '';
    public string $status = '';
    public $join_date;
    public $resign_date;
    public $nik;
    public string $name = '';
    public $areas = [];
    public $area_id;

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function mount()
    {
        $this->areas = AreaPayroll::pluck('area', 'id');
    }

    public function render()
    {
        return view('livewire.dashboard.employee.employee-create');
    }
    
    public function store()
    {
        $validated = $this->validate([
            'name'  => ['required', 'string', 'max:255'],
            'client'  => ['required', 'string', 'max:255'],
            'status'  => ['required', 'string', 'max:255'],
            'join_date'  => ['required', 'date'],
            'resign_date'  => ['nullable', 'date'],
            'nik'  => ['required', 'numeric'],
            'area_id'  => ['required', 'numeric'],
        ]);

        $emp = EmployeeMaster::create($validated);

        if ($emp) {
            $existsInPivot = DB::table('employee_master_vendor')
            ->where('employee_master_id', $emp->id)
            ->where('vendor_id', $validated['vendor_id'])
            ->where('status', $validated['status'])
            ->exists();

            if (!$existsInPivot) {
                $emp->vendors()->attach($validated['vendor_id'], [
                    'status'   => $validated['status'],
                    'area_id'  => $validated['area_id'],
                ]);
            }
            
            $this->dispatch('employee-created');
            $this->dispatch('close-modal', name: 'create-employee-modal');
            $this->dispatch('alert-success', title: 'Employee Successfully Created!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Create Employee');
        }
    }
}

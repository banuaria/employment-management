<?php

namespace App\Livewire\Dashboard\Employee;

use App\Models\AreaPayroll;
use App\Models\EmployeeMaster;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
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
    public $vendor = [];
    public $vendor_id;

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function mount()
    {
        $this->areas = AreaPayroll::pluck('area', 'id');
        $this->vendor = Vendor::pluck('name', 'id');
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
            'area_id'  => ['required', 'numeric'],
            'vendor_id' => ['required'],
            'nik' => [
            'required',
            'numeric',
            Rule::unique('employee_masters')->where(fn ($query) => 
                $query->where('area_id', $this->area_id)
                      ->where('status', $this->status)
                      ->where('vendor_id', $this->vendor_id)
            ),
        ],
            
        ]);

        $emp = EmployeeMaster::create($validated);

        if ($emp) {
            $this->dispatch('employee-created');
            $this->dispatch('close-modal', name: 'create-employee-modal');
            $this->dispatch('alert-success', title: 'Employee Successfully Created!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Create Employee');
        }
    }
}

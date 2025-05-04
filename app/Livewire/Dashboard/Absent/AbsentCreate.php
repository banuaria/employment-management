<?php

namespace App\Livewire\Dashboard\Absent;

use App\Models\AbsentMonthlies;
use App\Models\AreaPayroll;
use App\Models\EmployeeMaster;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class AbsentCreate extends Component
{
    public $nik;
    public $selectedMonthYear;
    public $vendor = [];
    public $vendor_id;
    public $status;
    public $absent;
    public $bonus_absent;

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function mount()
    {
        $this->vendor = Vendor::pluck('name', 'id');
    }

    public function render()
    {
        return view('livewire.dashboard.absent.absent-create');
    }
    
    public function store()
    {
        $validated = $this->validate([
            'selectedMonthYear' => ['required', 'date_format:Y-m'],
            'nik'               => ['required', 'numeric', 'digits:16'],
            'vendor_id'         => ['required'],
            'status'            => ['required'],
            'absent'            => ['nullable', 'numeric'],
            'bonus_absent'      => ['required', 'numeric'],
        ]);

        $checkData = EmployeeMaster::where('nik', $validated['nik'])
            ->where('status', $validated['status'])
            ->where('vendor_id', $validated['vendor_id'])
            ->first();

        if (!$checkData) {
            $this->dispatch('alert-failure', title: 'Failed to Create Absent - Employee Not Found.');
            return;
        }

        $payload = [
            'month_year' => $validated['selectedMonthYear'] . '-01',
            'employee_id'    => $checkData->id,
            'vendor_id'      => $validated['vendor_id'],
            'status'         => $validated['status'],
            'absent'         => $validated['absent'] ?? 0,
            'bonus_absent'   => $validated['bonus_absent'],
        ];
        
        $data = AbsentMonthlies::create($payload);

        $this->dispatch('absent-created');
        $this->dispatch('close-modal', name: 'create-absent-modal');
        $this->dispatch('alert-success', title: 'Absent Successfully Created!');
    }

}

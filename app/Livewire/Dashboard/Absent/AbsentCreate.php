<?php

namespace App\Livewire\Dashboard\Ansent;

use App\Models\AbsentMonthlies;
use App\Models\AreaPayroll;
use App\Models\EmployeeMaster;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class AnsentCreate extends Component
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
        return view('livewire.dashboard.absent.absent-create');
    }
    
    public function store()
    {

        $validated = $this->validate([
            'selectedMonthYear' => ['required', 'date_format:Y-m'],
            'nik'  => ['required', 'numeric', 'max:16'],
            'vendor'  => ['required'],
            'status'  => ['required'],
            'absent'  => ['nullable', 'numeric'],
            'bonus_absent'  => ['required', 'numeric'],
        ]);

        $checkData = EmployeeMaster::where('nik', $this->nik)
            ->where('status', $this->status)
            ->where('vendor', $this->vendor)
            ->first();

        if($checkData){
            $emp = AbsentMonthlies::create([
                'selectedMonthYear' => $this->selectedMonthYear,
                'employee_id'       => $checkData->id,
                'vendor'            => $this->vendor,
                'status'            => $this->status,
                'absent'            => $this->absent,
                'bonus_absent'      => $this->bonus_absent,
            ]);
            $this->dispatch('absent-created');
            $this->dispatch('close-modal', name: 'create-absent-modal');
            $this->dispatch('alert-success', title: 'absent Successfully Created!');
        }else{
            $this->dispatch('alert-failure', title: 'Failed to Create absent');
        }

    }
}

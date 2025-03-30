<?php

namespace App\Livewire\Dashboard\Summary;

use App\Models\AreaPayroll;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class SummaryIndex extends Component
{
    use WithPagination;

    public $month = '';
    public $year = '';
    public string $selectedMonthYear = '';
    public $employees = [];
    protected $queryString = [
        'selectedMonthYear' => ['except' => ''],
    ];

    public function mount()
    {
        $this->selectedMonthYear = request()->query('selectedMonthYear', Carbon::now()->format('Y-m'));
    }

    public function applyFilter()
    {
        // Membuat URL tanpa /livewire
        $url = route('cms.summary') . '?selectedMonthYear=' . $this->selectedMonthYear;

        // Redirect ke URL yang baru
        return redirect()->to($url);
    }

    public function updatedSelectedMonthYear($value)
    {
        $this->selectedMonthYear = $value;
        $this->resetPage();
    }

    public function render()
    {
        $selectedMonthYear = $this->selectedMonthYear; 

        $summary = AreaPayroll::with(['employeeMaster' => function ($query) use ($selectedMonthYear) {
        $query->when($selectedMonthYear !== '', function ($q) use ($selectedMonthYear) {
                $q->where(function ($subQuery) use ($selectedMonthYear) {
                    foreach (['absent', 'clean', 'bbm', 'sla', 'insentif', 'lainya', 'lembur', 'makan', 'stand', 'previous', 'retribution'] as $relation) {
                        $subQuery->orWhereHas($relation, function ($subQ) use ($selectedMonthYear) {
                            $subQ->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%');
                        });
                    }
                });
            });
        }])
        ->when($selectedMonthYear !== '', function ($query) use ($selectedMonthYear) {
            $query->whereHas('employeeMaster', function ($q) use ($selectedMonthYear) {
                $q->where(function ($subQuery) use ($selectedMonthYear) {
                    foreach (['absent', 'clean', 'bbm', 'sla', 'insentif', 'lainya', 'lembur', 'makan', 'stand', 'previous', 'retribution'] as $relation) {
                        $subQuery->orWhereHas($relation, function ($subQ) use ($selectedMonthYear) {
                            $subQ->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%');
                        });
                    }
                });
            });
        })
        ->get();

    return view('livewire.dashboard.summary.summary-index', [
        'summary' => $summary,
    ])->layout('layouts.dashboard', [
        'header' => 'Summary'
    ]);

    }


    public function export($url)
    {
        $date = now()->format('Y-m-d');
        $fileName = 'summary-salary-' . $url . '.xlsx';

        $employees = AreaPayroll::with(['employeeMaster' => function ($query) use ($url) {
            $query->when($url !== '', function ($q) use ($url) {
                $q->where(function ($subQuery) use ($url) {
                    foreach (['absent', 'clean', 'bbm', 'sla', 'insentif', 'lainya', 'lembur', 'makan', 'stand', 'previous', 'retribution'] as $relation) {
                        $subQuery->orWhereHas($relation, function ($subQ) use ($url) {
                            $subQ->where('month_year', 'like', Carbon::parse($url)->format('Y-m') . '%');
                        });
                    }
                });
            });
        }])
        ->when($url !== '', function ($query) use ($url) {
            $query->whereHas('employeeMaster', function ($q) use ($url) {
                $q->where(function ($subQuery) use ($url) {
                    foreach (['absent', 'clean', 'bbm', 'sla', 'insentif', 'lainya', 'lembur', 'makan', 'stand', 'previous', 'retribution'] as $relation) {
                        $subQuery->orWhereHas($relation, function ($subQ) use ($url) {
                            $subQ->where('month_year', 'like', Carbon::parse($url)->format('Y-m') . '%');
                        });
                    }
                });
            });
        })
        ->get();

        return Excel::download(new \App\Exports\SalarySummaryExport($employees, $this->selectedMonthYear), $fileName);

    }    


}

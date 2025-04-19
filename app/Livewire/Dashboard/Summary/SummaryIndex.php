<?php

namespace App\Livewire\Dashboard\Summary;

use App\Exports\EmployeeSummary;
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
    public $monthView = '';
    protected $queryString = [
        'selectedMonthYear' => ['except' => ''],
    ];

    public function mount()
    {
        // Set the default value for monthView as the current month
        $this->monthView = Carbon::now()->format('Y-m');
        // The selectedMonthYear will only be updated based on the input from the user.
        $this->selectedMonthYear = $this->monthView;
    }

    public function updatedMonthView($value)
    {
        $this->selectedMonthYear = Carbon::parse($value)->format('Y-m');
        $this->resetPage(); // Reset pagination when the filter changes
    }

    public function render()
    {
        $selectedMonthYear = $this->selectedMonthYear;
        $relations = ['absent', 'clean', 'bbm', 'sla', 'insentif', 'lainya', 'lembur', 'makan', 'stand', 'previous', 'retribution'];

        $summary = AreaPayroll::with([
            'employeeMaster' => function ($query) use ($selectedMonthYear, $relations) {
                $query->with([
                    'absent' => fn ($q) => $q->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%'),
                    'lembur' => fn ($q) => $q->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%'),
                    'makan' => fn ($q) => $q->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%'),
                    'insentif' => fn ($q) => $q->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%'),
                    'stand' => fn ($q) => $q->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%'),
                    'previous' => fn ($q) => $q->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%'),
                    'retribution' => fn ($q) => $q->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%'),
                    'cut' => fn ($q) => $q->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%'),
                    'bbm' => fn ($q) => $q->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%'),
                    'clean' => fn ($q) => $q->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%'),
                    'sla' => fn ($q) => $q->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%'),
                    'lainya' => fn ($q) => $q->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%'),
                    'bpjs',
                ])
                    ->where(function ($subQuery) use ($selectedMonthYear, $relations) {
                    foreach ($relations as $relation) {
                        $subQuery->orWhereHas($relation, function ($subQ) use ($selectedMonthYear) {
                            $subQ->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%');
                        });
                    }
                });
            }
        ])
        ->whereHas('employeeMaster', function ($q) use ($selectedMonthYear, $relations) {
            $q->where(function ($subQuery) use ($selectedMonthYear, $relations) {
                foreach ($relations as $relation) {
                    $subQuery->orWhereHas($relation, function ($subQ) use ($selectedMonthYear) {
                        $subQ->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%');
                    });
                }
            });
        })
        ->get();

        return view('livewire.dashboard.summary.summary-index', [
            'summary' => $summary,
        ])->layout('layouts.dashboard', [
            'header' => 'Summary'
        ]);
    }

    public function export()
    {

        $selectedMonthYear = $this->selectedMonthYear;
        $fileName = 'employee-summary-' . $selectedMonthYear . '.xlsx';
        $relations = ['absent', 'clean', 'bbm', 'sla', 'insentif', 'lainya', 'lembur', 'makan', 'stand', 'previous', 'retribution'];

        $summary = AreaPayroll::with([
            'employeeMaster' => function ($query) use ($selectedMonthYear, $relations) {
                $query->with([
                    'absent' => fn ($q) => $q->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%'),
                    'lembur' => fn ($q) => $q->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%'),
                    'makan' => fn ($q) => $q->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%'),
                    'insentif' => fn ($q) => $q->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%'),
                    'stand' => fn ($q) => $q->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%'),
                    'previous' => fn ($q) => $q->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%'),
                    'retribution' => fn ($q) => $q->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%'),
                    'cut' => fn ($q) => $q->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%'),
                    'bbm' => fn ($q) => $q->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%'),
                    'clean' => fn ($q) => $q->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%'),
                    'sla' => fn ($q) => $q->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%'),
                    'lainya' => fn ($q) => $q->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%'),
                    'bpjs',
                ])
                    ->where(function ($subQuery) use ($selectedMonthYear, $relations) {
                    foreach ($relations as $relation) {
                        $subQuery->orWhereHas($relation, function ($subQ) use ($selectedMonthYear) {
                            $subQ->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%');
                        });
                    }
                });
            }
        ])
        ->whereHas('employeeMaster', function ($q) use ($selectedMonthYear, $relations) {
            $q->where(function ($subQuery) use ($selectedMonthYear, $relations) {
                foreach ($relations as $relation) {
                    $subQuery->orWhereHas($relation, function ($subQ) use ($selectedMonthYear) {
                        $subQ->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%');
                    });
                }
            });
        })
        ->get();
    
        // Jika data kosong, kirimkan respons
        if ($summary->isEmpty()) {
            return response()->json(['message' => 'No data found for the given filters.'], 404);
        }
    
        // Kirim data ke class export untuk diunduh
        return Excel::download(new EmployeeSummary($summary, $this->selectedMonthYear), $fileName);
    }


}

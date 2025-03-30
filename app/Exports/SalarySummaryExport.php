<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromView;

class SalarySummaryExport implements FromView, WithColumnFormatting, ShouldAutoSize
{
    protected $employMaster;
    protected $selectedMonthYear;

    public function __construct($employMaster, $selectedMonthYear)
    {
        $this->employMaster = $employMaster;
        $this->selectedMonthYear = $selectedMonthYear;
    }

    public function view(): \Illuminate\Contracts\View\View
    {
        return view('exports.salary_summary', [
            'employees' => $this->employMaster,
            'selectedMonthYear' => $this->selectedMonthYear,
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'B'  => '#,##0', // Total Gaji Pokok
            'C'  => '#,##0', // Lembur
            'D'  => '#,##0', // Uang Standby
            'E'  => '#,##0', // Uang Makan
            'F'  => '#,##0', // Bonus Kehadiran
            'G'  => '#,##0', // Bonus/Denda Kebersihan
            'H'  => '#,##0', // Bonus/Denda SLA
            'I'  => '#,##0', // Bonus/Denda BBM
            'J'  => '#,##0', // Retribusi
            'K'  => '#,##0', // Insentif Tomorow
            'L'  => '#,##0', // Lain-lain
            'M'  => '#,##0', // Selisih Bulan Lalu
            'N'  => '#,##0', // JHT
            'O'  => '#,##0', // JKK
            'P'  => '#,##0', // JKM
            'Q'  => '#,##0', // JP
            'R'  => '#,##0', // KES
            'S'  => '#,##0', // Total BPJS
            'T'  => '#,##0', // Potongan Gaji
            'U'  => '#,##0', // Total Budget
            'V'  => '#,##0', // Mg. Fee
            'W'  => '#,##0', // PPN 11%
            'X'  => '#,##0', // PPh 23 / Final
            'Y'  => '#,##0', // TOTAL INVOICE
        ];
    }
}
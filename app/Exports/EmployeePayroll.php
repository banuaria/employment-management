<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EmployeePayroll implements FromView, WithColumnFormatting, ShouldAutoSize
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
        return view('exports.employe_monthly', [
            'employees' => $this->employMaster,
            'selectedMonthYear' => $this->selectedMonthYear,
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'J'  => '#,##0', // Total Gaji Pokok
            'K'  => '#,##0', // Lembur
            'L'  => '#,##0', // Uang Standby
            'M'  => '#,##0', // Uang Makan
            'N'  => '#,##0', // Bonus Kehadiran
            'O'  => '#,##0', // Bonus/Denda Kebersihan
            'P'  => '#,##0', // Bonus/Denda SLA
            'Q'  => '#,##0', // Bonus/Denda BBM
            'R'  => '#,##0', // Retribusi
            'S'  => '#,##0', // Insentif Tomorow
            'T'  => '#,##0', // Lain-lain
            'U'  => '#,##0', // Selisih Bulan Lalu
            'V'  => '#,##0', // JHT
            'W'  => '#,##0', // JKK
            'X'  => '#,##0', // JKM
            'Y'  => '#,##0', // JP
            'Z'  => '#,##0', // KES
            'AA' => '#,##0', // Total BPJS
            'AB' => '#,##0', // Potongan Gaji
            'AC' => '#,##0', // Total Budget
            'AD' => '#,##0', // Mg. Fee (gunakan dua desimal)
            'AE' => '#,##0', // PPN 11% (gunakan dua desimal)
            'AF' => '#,##0', // PPh 23 / Final (gunakan dua desimal)
            'AD' => '#,##0', // Mg. Fee (gunakan dua desimal)
            'AE' => '#,##0',
            'AF' => '#,##0',
            'AF' => '#,##0', 
            'AG' => '#,##0', 
            'AH' =>'#,##0',
            'AI' =>'#,##0',
            'AJ' => '#,##0', // TOTAL INVOICE
        ];
    }
}

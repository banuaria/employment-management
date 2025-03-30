<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeePayroll implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting
{
    protected $employees;
    protected $selectedMonthYear;

    public function __construct($employees, $selectedMonthYear)
    {
        $this->employees = $employees;
        $this->selectedMonthYear = $selectedMonthYear;
    }

    public function collection()
    {
        // Mengembalikan collection yang berisi data employee, bisa juga ditambah selectedMonthYear jika perlu
        return collect([
            'employees' => $this->employees,
            'selectedMonthYear' => $this->selectedMonthYear
        ]);
    }


    public function headings(): array
    {
        return [
            'Vendor',
            'Client',
            'Join Date',
            'Resign Date',
            'Client',
            'Status+Area',
            'NIK',
            'Name',
            'Area',
            'Total Gaji Pokok',
            'Lembur',
            'Uang Standby',
            'Uang Makan',
            'Bonus Kehadiran',
            'Bonus/Denda Kebersihan',
            'Bonus/Denda SLA',
            'Bonus/Denda BBM',
            'Retribusi',
            'Insentif Tomorow',
            'Lain-lain',
            'Selisih Bulan Lalu',
            'JHT',
            'JKK',
            'JKM',
            'JP',
            'KES',
            'Total BPJS',
            'Potongan Gaji',
            'Total Budget',
            'Mg. Fee',
            'PPN 11%',
            'PPh 23 / Final',
            'TOTAL INVOICE'
        ];
    }


    public function map($employees): array
    {
        $rows = [];
        
        // Pastikan $employees adalah koleksi yang berisi banyak employee
        foreach ($employees as $employee) {
            $vendors = $employee->vendors ?: collect();
            // Iterate over vendors (vendors should be related to employee)
            foreach ($vendors as $vendor) {
                if ($employee->client == 'Security' || $employee->client == 'Office Boy') {
                    $salary = $employee->area->umk;
                } else {
                    $salary = ($employee->area->umk >= 4000000) 
                        ? $employee->area->umk * 0.80  // If UMK > 4M, take 80%
                        : $employee->area->umk * 0.90; // If UMK < 4M, take 90%
                }
            
                // Adjust Salary for specific employee statuses
                if ($employee->status == 'HARIAN') {
                    $calt = $employee->absent
                        ->where('month_year', $this->selectedMonthYear . '-01')
                        ->where('vendor_id', $vendor->id)
                        ->sum('absent');
                    $salary = ($employee->area->total_harian * $calt) ?? $employee->area->total_harian;
                }

                $totalLembur = $employee->lembur
                ->where('month_year',$this->selectedMonthYear . '-01')
                ->where('vendor_id', $vendor->id)
                ->sum('total');

                $totalStand = $employee->stand
                ->where('month_year',$this->selectedMonthYear . '-01')
                ->where('vendor_id', $vendor->id)
                ->sum('total');

                $totalMakan = $employee->makan
                ->where('month_year',$this->selectedMonthYear . '-01')
                ->where('vendor_id', $vendor->id)
                ->sum('total');

                $totalMEL = $employee->makan
                ->where('month_year',$this->selectedMonthYear . '-01')
                ->where('vendor_id', $vendor->id)
                ->sum('total_mel');

                $totalUNIT = $employee->makan
                ->where('month_year',$this->selectedMonthYear . '-01')
                ->where('vendor_id', $vendor->id)
                ->sum('total_unit');

                $totalLOADING = $employee->makan
                ->where('month_year',$this->selectedMonthYear . '-01')
                ->where('vendor_id', $vendor->id)
                ->sum('total_loading');

                $totalAbsent = $employee->absent
                ->where('month_year',$this->selectedMonthYear . '-01')
                ->where('vendor_id', $vendor->id)
                ->sum('incentive_amount');

                $employeeClean = $employee->clean->where('month_year', $this->selectedMonthYear . '-01')->where('vendor_id', $vendor->id);
                $employeeSLA = $employee->sla->where('month_year', $this->selectedMonthYear . '-01')->where('vendor_id', $vendor->id);

                // Cek jika clean dan sla bukan koleksi, ambil data dengan get()
                if (!($employeeClean instanceof \Illuminate\Database\Eloquent\Collection)) {
                    $employeeClean = $employee->clean()->get();  // Memastikan $employee->clean adalah koleksi
                }
                if (!($employeeSLA instanceof \Illuminate\Database\Eloquent\Collection)) {
                    $employeeSLA = $employee->sla()->get();  // Memastikan $employee->sla adalah koleksi
                }
                                
                $totalClean = 0; 
                foreach ($employeeClean as $clean) {
                    if ($clean->total > 3) {
                        $totalClean += $clean->bonus_penalty;
                    } else {
                        $totalClean -= $clean->bonus_penalty;
                    }
                }

                $totalSLA = 0;
                foreach ($employeeSLA as $sla) {
                    if ($sla->total  >= 80) {
                        $totalSLA += $sla->total_sla;
                    } else {
                        $totalSLA -= $sla->total_sla;
                    }
                }

                $totalBBM = $employee->bbm
                ->where('month_year',$this->selectedMonthYear . '-01')
                ->where('vendor_id', $vendor->id)
                ->sum('total');

                $totalRetri = $employee->retribution
                ->where('month_year',$this->selectedMonthYear . '-01')
                ->where('vendor_id', $vendor->id)
                ->sum('total');

                $totalInsentif = $employee->insentif
                ->where('month_year',$this->selectedMonthYear . '-01')
                ->where('vendor_id', $vendor->id)
                ->sum('total');

                $totalLainya = $employee->lainya
                ->where('month_year',$this->selectedMonthYear . '-01')
                ->where('vendor_id', $vendor->id)
                ->sum('total');

                $totalPrev = $employee->previous
                ->where('month_year',$this->selectedMonthYear . '-01')
                ->where('vendor_id', $vendor->id)
                ->sum('total');

                $calculate1 = $salary+$totalLembur+$totalStand+$totalMakan+$totalMEL+$totalUNIT+$totalLOADING+$totalAbsent; 
                $calculate2 = 0;
                $calculate3 = 0;
                foreach ($employeeClean as $clean) {
                    if ($clean->total > 3) {
                        $cleanTotal = $clean->total;
                        $calculate2 = $calculate1+$totalClean;
                    } else {
                        $cleanTotal = '-' . $clean->total;
                        $calculate2 = $calculate1-$totalClean;
                    }
                }
                if ($calculate2 == 0) {
                    $calculate2 = $calculate1;
                }
                
                foreach ($employeeSLA as $sla) {
                    if ($sla->total  >= 80) {
                        $slaTotal = $sla->total;
                        $calculate3 = $calculate2+$totalSLA;
                    } else {
                        $slaTotal = '-' .$sla->total;
                        $calculate3 = $calculate2-$totalSLA;
                    }
                }
                if($calculate3 == 0){
                    $calculate3 = $calculate2;
                }

                $calculate4 = $calculate3+$totalBBM+$totalRetri+$totalInsentif+$totalLainya+$totalPrev;
                $calculate5 = $calculate4+$employee->bpjs->total_bpjs;

                $mgFee = $calculate5 * 0.05;
                $ppn = $mgFee * 0.11;
                $pph = 0.02 * $mgFee;
                $totalInvoice = $calculate5 + $mgFee + $ppn + $pph;

                $rows[] = [
                    $vendor->name,
                    $employee->client,
                    $employee->join_date ? Carbon::parse($employee->join_date)->translatedFormat('M d, Y') : '-',
                    $employee->resign_date ? Carbon::parse($employee->resign_date)->translatedFormat('M d, Y') : '-',
                    $employee->status . ' ' . ($employee->area->area ?? 'N/A'),
                    $employee->nik,
                    $employee->name,
                    $employee->area->area ?? 'N/A',
                    (int) $salary,
                    (int) $totalLembur,
                    (int) $totalStand,
                    (int) $totalMakan,
                    (int) $totalMEL,
                    (int) $totalUNIT,
                    (int) $totalLOADING,
                    (int) $totalAbsent,
                    $cleanTotal > 3 
                        ? (int) $totalClean 
                        : -(int) $totalClean,
                    $slaTotal >= 80 
                        ? (int) $totalSLA 
                        : -(int) $totalSLA,
                    (int) $totalBBM,
                    (int) $totalRetri,
                    (int) $totalInsentif,
                    (int) $totalLainya,
                    (int) $totalPrev,
                    (int) $employee->bpjs->jht,
                    (int) $employee->bpjs->jkk,
                    (int) $employee->bpjs->jkm,
                    (int) $employee->bpjs->jp,
                    (int) $employee->bpjs->kes,
                    (int) $employee->bpjs->total_bpjs,
                    0, // Additional column (can be used for a different purpose if needed)
                    (int) $calculate5,
                    (int) $mgFee,
                    (int) $ppn,
                    (int) $pph,
                    (int) $totalInvoice,
                ];
                // dd($rows);
            
            }
           
    
            // If no vendors exist, still output a row with 'N/A' for Vendor
            // if ($employee->vendors->isEmpty()) {
            //     $rows[] = [
            //         'N/A',
            //         $employee->client,
            //         $employee->join_date ? Carbon::parse($employee->join_date)->translatedFormat('M d, Y') : '-',
            //         $employee->resign_date ? Carbon::parse($employee->resign_date)->translatedFormat('M d, Y') : '-',
            //         $employee->status . ' ' . ($employee->area->area ?? 'N/A'),
            //         $employee->nik,
            //         $employee->name,
            //         $employee->area->area ?? 'N/A',
            //         (int) $salary,
            //         (int) $totalLembur,
            //         (int) $totalStand,
            //         (int) $totalMakan,
            //         (int) $totalMEL,
            //         (int) $totalUNIT,
            //         (int) $totalLOADING,
            //         (int) $totalAbsent,
            //         $cleanTotal > 3 
            //             ? (int) $totalClean 
            //             : -(int) $totalClean,
            //         $slaTotal >= 80 
            //             ? (int) $totalSLA 
            //             : -(int) $totalSLA,
            //         (int) $totalBBM,
            //         (int) $totalRetri,
            //         (int) $totalInsentif,
            //         (int) $totalLainya,
            //         (int) $totalPrev,
            //         (int) $employee->bpjs->jht,
            //         (int) $employee->bpjs->jkk,
            //         (int) $employee->bpjs->jkm,
            //         (int) $employee->bpjs->jp,
            //         (int) $employee->bpjs->kes,
            //         (int) $employee->bpjs->total_bpjs,
            //         0, // Additional column (can be used for a different purpose if needed)
            //         (int) $calculate5,
            //         (int) $mgFee,
            //         (int) $ppn,
            //         (int) $pph,
            //         (int) $totalInvoice,
            //     ];
            // }
        }
    
        return $rows;
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
            'AD' => '#,##0.00', // Mg. Fee (gunakan dua desimal)
            'AE' => '#,##0.00', // PPN 11% (gunakan dua desimal)
            'AF' => '#,##0.00', // PPh 23 / Final (gunakan dua desimal)
            'AG' => '#,##0', // TOTAL INVOICE
        ];
    }

}

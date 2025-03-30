<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Support\Collection;
class SalarySummaryExport implements FromCollection, WithHeadings, ShouldAutoSize, WithColumnFormatting
{
    protected $employees, $selectedMonthYear;

    public function __construct($employees, $selectedMonthYear)
    {
        $this->employees = $employees;
        $this->selectedMonthYear = $selectedMonthYear;
    }

    public function collection()
    {
        $data = collect();
        $totalGaji = 0;
        $mgFee = 0;
        $ppn = 0;
        $pph = 0;
        $totalInvoice = 0;


        foreach ($this->employees as $value) {

            if ($value->client == 'Security' || $value->client == 'Office Boy') {
                $salary = $value->area->umk;
            } else {
                // Driver
                if ($value->area->umk >= 4000000) {
                    $salary = $value->area->umk * 0.80; // Jika UMK di atas 4.000.000, dikali 80%
                } else {
                    $salary = $value->area->umk * 0.90; // Jika UMK di bawah 4.000.000, dikali 90%
                }
            }
            if ($value->status == 'HARIAN') {
                $calt = $value->absent->where('month_year',$this->selectedMonthYear . '-01')->where('vendor_id', $value->id)->sum('absent');
                // dd($calt, $$value->area->total_harian);
                $salary = ($value->area->total_harian * $calt) ?? $value->area->total_harian;
            } else {
                // Driver
                if ($value->area->umk >= 4000000) {
                    $salary = $value->area->umk * 0.80; // Jika UMK di atas 4.000.000, dikali 80%
                } else {
                    $salary = $value->area->umk * 0.90; // Jika UMK di bawah 4.000.000, dikali 90%
                }
            }

                $total = $salary + $value->total_lembur + $value->total_stand +
                $value->total_makan + $value->total_bonus_kehadiran + $value->total_kebersihan +
                $value->total_sla + $value->total_bbm + $value->total_retribusi +
                $value->total_insentif + $value->total_lainnya + $value->total_previous +
                $value->total_bpjs;

            $fee = $total * 0.05;
            $taxPpn = $fee * 0.11;
            $taxPph = $total * 0.2;
            $invoice = $total + $fee + $taxPpn + $taxPph;

            $data->push([
                $value->area,
                $value->salary,
                $value->total_lembur,
                $value->total_stand,
                $value->total_makan,
                $value->total_bonus_kehadiran,
                $value->total_kebersihan,
                $value->total_sla,
                $value->total_bbm,
                $value->total_retribusi,
                $value->total_insentif,
                $value->total_lainnya,
                $value->total_previous,
                $value->total_bpjs,
                $total,
                $fee,
                $taxPpn,
                $taxPph,
                $invoice,
            ]);

            $totalGaji += $total;
            $mgFee += $fee;
            $ppn += $taxPpn;
            $pph += $taxPph;
            $totalInvoice += $invoice;
        }

        // Tambah baris total akumulasi
        $data->push([
            'Total',
            $this->employees->sum('total_salary'),
            $this->employees->sum('total_lembur'),
            $this->employees->sum('total_stand'),
            $this->employees->sum('total_makan'),
            $this->employees->sum('total_bonus_kehadiran'),
            $this->employees->sum('total_kebersihan'),
            $this->employees->sum('total_sla'),
            $this->employees->sum('total_bbm'),
            $this->employees->sum('total_retribusi'),
            $this->employees->sum('total_insentif'),
            $this->employees->sum('total_lainnya'),
            $this->employees->sum('total_previous'),
            $this->employees->sum('total_bpjs'),
            $totalGaji,
            $mgFee,
            $ppn,
            $pph,
            $totalInvoice,
        ]);

        return $data;
    }

    public function headings(): array
    {
        return [
            'Area', 'Total Salary', 'Total Lembur', 'Total Stand', 'Total Makan', 'Total Bonus Kehadiran',
            'Total Kebersihan', 'Total SLA', 'Total BBM', 'Total Retribusi', 'Total Insentif', 'Total Lainnya',
            'Total Previous', 'Total BPJS', 'Total Gaji', 'Management Fee', 'PPN', 'PPh', 'Total Invoice'
        ];
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
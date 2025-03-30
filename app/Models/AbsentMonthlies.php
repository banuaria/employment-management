<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class AbsentMonthlies extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = [
        'employee_id',
        'vendor_id',
        'month_year',
        'absent',
    ];

    public function employeeMaster()
    {
        return $this->belongsTo(EmployeeMaster::class, 'employee_id');
    }

    public function vendors()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function getTotalUmkAttribute()
    {
        $employee = $this->employeeMaster;

        if (!$employee || !$employee->area) {
            return 0; // Jika tidak ada data employee atau area, kembalikan 0
        }

        if ($employee->client == 'Security' || $employee->client == 'Office Boy') {
            return $employee->area->umk;
        } else {
            // Driver
            return ($employee->area->umk >= 4000000)
                ? $employee->area->umk * 0.80 // Jika UMK di atas 4.000.000, dikali 80%
                : $employee->area->umk * 0.90; // Jika UMK di bawah 4.000.000, dikali 90%
        }
    }

    public function getIncentiveAmountAttribute()
    {
        if($this->employeeMaster->status == 'HARIAN') {
            $salary = optional($this->employeeMaster->area)->total_harian; 
            $baseIncentive = $salary;
        }else{
            $salary = optional($this->employeeMaster->area)->umk;
            $baseIncentive = ($salary >= 4000000) ? 200000 : 100000; // Logika insentif dasar
        }

         // Panggil fungsi total hari dalam bulan
        $totalDaysData = $this->getTotalDaysInMonthAttribute();
        $totalMonthEmployee = $totalDaysData['total_month_employee'] ?? 0; // Ambil total bulan karyawan

        $absentDays = $this->absent ?? 0; // Jumlah hari absen

        // Debugging (hapus setelah dicek)
        
        // Perhitungan insentif setelah dikurangi absensi
        $incentiveDeduction = ($baseIncentive / max(1, $totalMonthEmployee)) * $absentDays;

        // dd($absentDays, $totalMonthEmployee, $incentiveDeduction);
        // $finalIncentive = max(0, $baseIncentive - $incentiveDeduction);

        // dd($totalDaysData, $totalMonthEmployee, $absentDays, $incentiveDeduction,);
        
        return round($incentiveDeduction, 0); // Kembalikan hasil pembulatan
    }

    // Metode untuk menghitung jumlah hari dalam bulan & total hari kerja
    public function getTotalDaysInMonthAttribute()
    {
        $monthYear = $this->month_year; // Format: YYYY-MM
        $startDate = Carbon::parse($monthYear . '-01');
        $endDate = $startDate->copy()->endOfMonth();

        $totalDays = $endDate->day; // Jumlah total hari dalam bulan
        $weekendDays = 0;
        $publicHolidayCount = 0;

        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            // Hitung Sabtu dan Minggu
            if ($date->isSaturday() || $date->isSunday()) {
                $weekendDays++;
                continue;
            }

            // Hitung tanggal merah
            if ($this->isPublicHoliday($date)) {
                $publicHolidayCount++;
            }
        }

        $totalWorkingDays = $totalDays - $weekendDays - $publicHolidayCount;
        $totalMonthEmployee = $totalDays - $publicHolidayCount;

        return [
            'total_days' => $totalDays,
            'weekend_days' => $weekendDays,
            'public_holidays' => $publicHolidayCount,
            'working_days' => $totalWorkingDays,
            'total_month_employee' => $totalMonthEmployee,
        ];
    }

    private function isPublicHoliday($date)
    {
        $year = $date->format('Y');

        // Check if holiday data is cached
        $holidays = Cache::get("holidays_$year");

        if (!$holidays) {
            // If not cached, fetch the data from the API
            $response = Http::get("https://api-harilibur.vercel.app/api?year=$year");

            if ($response->successful()) {
                $holidays = collect($response->json())->pluck('holiday_date')->toArray();
                // Cache the holiday data for 1 year
                Cache::put("holidays_$year", $holidays, now()->addYear());
            } else {
                $holidays = [];
            }
        }

        // Check if the date is in the list of holidays
        return in_array($date->format('Y-m-d'), $holidays);
    }

}

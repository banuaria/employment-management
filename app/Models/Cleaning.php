<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cleaning extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'employee_id',
        'vendor_id',
        'month_year',
        'total',
    ];

    public function employeeMaster()
    {
        return $this->belongsTo(EmployeeMaster::class, 'employee_id');
    }

    public function vendors()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    // Ambil Gaji Pokok Berdasarkan UMK
    private function getBaseSalary()
    {
        $employee = $this->employeeMaster;

        if (!$employee || !$employee->area->umk) {
            return 0; // Jika tidak ada data employee atau area, kembalikan 0
        }

        $umk = $employee->area->umk ?? 0;
        return ($umk > 4000000) ? ($umk * 0.8) : ($umk * 0.9);
    }

    // Hitung Bonus atau Denda Sekali Saja (satu return)
    public function getBonusPenaltyAttribute()
    {
        $employee = $this->employeeMaster;

        if (!$employee || !$employee->area->umk) {
            return 0; 
        }

        $total = $this->total; // Ambil jumlah cuci dari database
        $is80 = ($employee->area->umk > 4000000); // UMK > 4jt = 80%, selain itu 90%

        // Bonus (jika total cuci = 4)
        if ($total == 4) {
            return $is80 ? 200000 : 100000; // Bonus positif
        }else{
            $penaltyMapping = [
                3 => $is80 ? 100000 : 50000,
                2 => $is80 ? 200000 : 100000,
                1 => $is80 ? 300000 : 150000,
                0 => $is80 ? 400000 : 200000,
            ];
            return $penaltyMapping[$total] ?? 0;
        }
        
    }



}

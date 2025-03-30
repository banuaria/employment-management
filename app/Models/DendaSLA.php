<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DendaSLA extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'denda_slas';

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

    public function getTotalSlaAttribute()
    {
        // dd('dsa');
        $umk = $this->employeeMaster->area->umk ?? 0;
        $gapok = ($umk > 4000000) ? 80 : 90; // Tentukan kategori 80% atau 90%
        $percentage = $this->total; // Ambil SLA performance dari database

        // Mapping kompensasi berdasarkan kategori gaji pokok
        $compensationMapping = [
            80 => [
                '>=80' => 200000,
                '70-79' => 100000,
                '60-69' => 300000,
                '50-59' => 600000,
                '40-49' => 600000,
                '30-39' => 600000,
                '<29' => 600000,
            ],
            90 => [
                '>=80' => 100000,
                '70-79' => 50000,
                '60-69' => 150000,
                '50-59' => 300000,
                '40-49' => 300000,
                '30-39' => 300000,
                '<29' => 300000,
            ],
        ];

        // Menentukan kategori berdasarkan nilai total (SLA performance)
        if ($percentage >= 80) {
            $category = '>=80';
        } elseif ($percentage >= 70) {
            $category = '70-79';
        } elseif ($percentage >= 60) {
            $category = '60-69';
        } elseif ($percentage >= 50) {
            $category = '50-59';
        } elseif ($percentage >= 40) {
            $category = '40-49';
        } elseif ($percentage >= 30) {
            $category = '30-39';
        } else {
            $category = '<29';
        }

        return $compensationMapping[$gapok][$category] ?? 0;
    }

}

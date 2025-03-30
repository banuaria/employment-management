<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Makan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'employee_id',
        'vendor_id',
        'month_year',
        'total',
        'total_mel',
        'total_unit',
        'total_loading',

    ];

    public function employeeMaster()
    {
        return $this->belongsTo(EmployeeMaster::class, 'employee_id');
    }

    public function vendors()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
    
}

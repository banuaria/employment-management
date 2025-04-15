<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insentif extends Model
{
    use HasFactory;

    public $timestamps = false;

    // protected $table = 'insentif';

    protected $fillable = [
        'employee_id',
        'vendor_id',
        'month_year',
        'status',
        'total',
    ];

    public function getStatusNameAttribute()
    {
        return match ($this->status) {
            1 => 'REGULER',
            2 => 'LOADING',
            3 => 'HARIAN',
            default => 'UNKNOWN',
        };
    }


    public function employeeMaster()
    {
        return $this->belongsTo(EmployeeMaster::class, 'employee_id');
    }

    public function vendors()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

}

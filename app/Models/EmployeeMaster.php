<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'client',
        'area_id',
        'vendor_id',
        'status',
        'join_date',
        'resign_date',
        'nik',
        'name',
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


    public function vendors()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function area()
    {
        return $this->belongsTo(AreaPayroll::class, 'area_id');
    }

    public function lembur()
    {
        return $this->hasMany(Lembur::class, 'employee_id');
    }

    public function stand()
    {
        return $this->hasMany(Stand::class, 'employee_id');
    }


    public function absent()
    {
        return $this->hasMany(AbsentMonthlies::class, 'employee_id');
    }

    public function clean()
    {
        return $this->hasMany(Cleaning::class, 'employee_id');
    }

    public function bbm()
    {
        return $this->hasMany(BonusBBM::class, 'employee_id');
    }

    public function sla()
    {
        return $this->hasMany(DendaSLA::class, 'employee_id');
    }

    public function insentif()
    {
        return $this->hasMany(Insentif::class, 'employee_id');
    }
    
    public function lainya()
    {
        return $this->hasMany(Lainya::class, 'employee_id');
    }

  
    public function cut()
    {
        return $this->hasMany(CutSalary::class, 'employee_id');
    }
    
    public function makan()
    {
        return $this->hasMany(Makan::class, 'employee_id');
    }
   
    public function previous()
    {
        return $this->hasMany(PreviousMonth::class, 'employee_id');
    }

    public function retribution()
    {
        return $this->hasMany(Retribution::class, 'employee_id');
    }

    public function bpjs()
    {
        return $this->hasOne(EmployBpjs::class, 'employee_id');
    }
}

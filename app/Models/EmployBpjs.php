<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployBpjs extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = 'employ_bpjs';

    protected $fillable = [
        'employee_id',
        'jht',
        'jkk',
        'jkm',
        'jp',
        'kes',
        'vendor_id',
        'status',
    ];

    public function employeeMaster()
    {
        return $this->belongsTo(EmployeeMaster::class, 'employee_id');
    }

    public function getTotalBpjsAttribute()
    {
        if (!$this->employee_id) {
            return 0;
            // dd('dsa');
        }
        return $this->where('employee_id', $this->employee_id)
            ->sum(\DB::raw('jht + jkk + jkm + jp + kes'));
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function employeeMasters()
    {
        return $this->belongsToMany(EmployeeMaster::class, 'employee_master_vendor');
    }

    public function absent()
    {
        return $this->belongsToMany(AbsentMonthlies::class, 'vendor_id');
    }


}

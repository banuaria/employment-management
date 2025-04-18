<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

class AreaPayroll extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $selectedMonthYear;

    protected $fillable = [
        'name',
        'area',
        'name',
        'umk',
        'total_harian',
    ];

    public function employeeMaster()
    {
        return $this->hasMany(EmployeeMaster::class, 'area_id');
    }
    
}
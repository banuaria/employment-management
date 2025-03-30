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

    public function employeeMaster()
    {
        return $this->hasMany(EmployeeMaster::class, 'area_id');
    }

    public function getTotalSalaryAttribute()
    {
        $selectedMonthYear = request()->query('selectedMonthYear', Carbon::now()->format('Y-m'));
        // dd($selectedMonthYear);

        return $this->employeeMaster()
            ->with('area', 'vendors', 'absent')
            ->whereHas('absent', function ($query) use ($selectedMonthYear) {
                $query->where('month_year', $selectedMonthYear . '-01');
            })
            ->get()
            ->sum(function ($employee) use ($selectedMonthYear) {
                $umk = $employee->area->umk;
                $salary = 0;
    
                // Perhitungan berdasarkan client
                if (in_array($employee->client, ['Security', 'Office Boy'])) {
                    $salary = $umk;
                } else {
                    // Driver
                    $salary = ($umk >= 4000000) ? $umk * 0.80 : $umk * 0.90;
                }
    
                // Perhitungan berdasarkan status
                if ($employee->status == 'HARIAN') {
                    $calt = $employee->absent->where('month_year', $selectedMonthYear)->sum('absent');
                    $salary = ($this->total_harian * $calt) ?: $this->total_harian;
                    // dd($salary);
                } else {
                    $salary = ($umk >= 4000000) ? $umk * 0.80 : $umk * 0.90;
                }
    
                // Kalkulasi gaji berdasarkan vendor
                $vendorSalary = 0;
                foreach ($employee->vendors as $vendor) {
                    $vendorSalary += $salary;
                }
    
                return $vendorSalary;
            });
    }


    public function getTotalLemburAttribute()
    {
        $selectedMonthYear = request()->query('selectedMonthYear', Carbon::now()->format('Y-m'));

        return $this->employeeMaster()
            ->with('lembur', 'vendors')
            ->get()
            ->sum(function ($employee) use ($selectedMonthYear) {
                $totalLembur = 0;

                foreach ($employee->vendors as $vendor) {
                    // Ambil data lembur berdasarkan employee, vendor, dan selectedMonthYear
                    $lembur = $employee->lembur()   
                        ->where('vendor_id', $vendor->id)
                        ->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%') // Filter berdasarkan bulan & tahun
                        ->first(); 
                    // dd($lembur);    

                    if ($lembur) {
                        $totalLembur += $lembur->total; 
                    }
                }

                return $totalLembur;
            });
    }

    public function getTotalStandAttribute()
    {
        $selectedMonthYear = request()->query('selectedMonthYear', Carbon::now()->format('Y-m'));
        return $this->employeeMaster()
            ->with('stand', 'vendors')
            ->get()
            ->sum(function ($employee) use ($selectedMonthYear) {
                $totalStand = 0;

                foreach ($employee->vendors as $vendor) {
                    // Ambil data lembur berdasarkan employee, vendor, dan selectedMonthYear
                    $lembur = $employee->stand()   
                        ->where('vendor_id', $vendor->id)
                        ->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%') // Filter berdasarkan bulan & tahun
                        ->first(); 
                    // dd($lembur);    

                    if ($lembur) {
                        $totalStand += $lembur->total; 
                    }
                }

                // dd($this->selectedMonthYear);
                return $totalStand;
            });
    }


    public function getTotalMakanAttribute()
    {
        $selectedMonthYear = request()->query('selectedMonthYear', Carbon::now()->format('Y-m'));
        return $this->employeeMaster()
            ->with(['makan', 'vendors'])
            ->get()
            ->sum(function ($employee) use ($selectedMonthYear) {
                $totalMakan = 0;
    
                foreach ($employee->vendors as $vendor) {
                    // Ambil data makan berdasarkan employee, vendor, dan selectedMonthYear
                    $makan = $employee->makan()
                        ->where('vendor_id', $vendor->id)
                        ->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%')
                        ->first(); 
    
                    if ($makan) {
                        $totalMakan += $makan->total; 
                    }
                }
    
                return $totalMakan;
            });
    }

    public function getTotalMelAttribute()
    {
        $selectedMonthYear = request()->query('selectedMonthYear', Carbon::now()->format('Y-m'));
        return $this->employeeMaster()
            ->with(['makan', 'vendors'])
            ->get()
            ->sum(function ($employee) use ($selectedMonthYear) {
                $totalMakan = 0;
    
                foreach ($employee->vendors as $vendor) {
                    // Ambil data makan berdasarkan employee, vendor, dan selectedMonthYear
                    $makan = $employee->makan()
                        ->where('vendor_id', $vendor->id)
                        ->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%')
                        ->first(); 
    
                    if ($makan) {
                        $totalMakan += $makan->total_mel; 
                    }
                }
    
                return $totalMakan;
            });
    }

    public function getTotalUnitAttribute()
    {
        $selectedMonthYear = request()->query('selectedMonthYear', Carbon::now()->format('Y-m'));
        return $this->employeeMaster()
            ->with(['makan', 'vendors'])
            ->get()
            ->sum(function ($employee) use ($selectedMonthYear) {
                $totalMakan = 0;
    
                foreach ($employee->vendors as $vendor) {
                    // Ambil data makan berdasarkan employee, vendor, dan selectedMonthYear
                    $makan = $employee->makan()
                        ->where('vendor_id', $vendor->id)
                        ->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%')
                        ->first(); 
    
                    if ($makan) {
                        $totalMakan += $makan->total_unit; 
                    }
                }
    
                return $totalMakan;
            });
    }

    public function getTotalLoadingAttribute()
    {
        $selectedMonthYear = request()->query('selectedMonthYear', Carbon::now()->format('Y-m'));
        return $this->employeeMaster()
            ->with(['makan', 'vendors'])
            ->get()
            ->sum(function ($employee) use ($selectedMonthYear) {
                $totalMakan = 0;
    
                foreach ($employee->vendors as $vendor) {
                    // Ambil data makan berdasarkan employee, vendor, dan selectedMonthYear
                    $makan = $employee->makan()
                        ->where('vendor_id', $vendor->id)
                        ->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%')
                        ->first(); 
    
                    if ($makan) {
                        $totalMakan += $makan->total_loading; 
                    }
                }
    
                return $totalMakan;
            });
    }
    

    public function getTotalBonusKehadiranAttribute()
    {
        $selectedMonthYear = request()->query('selectedMonthYear', Carbon::now()->format('Y-m'));
        return $this->employeeMaster()
        ->with(['absent' => function ($query) use ($selectedMonthYear) {
            $query->whereYear('month_year', Carbon::parse($selectedMonthYear)->year)
                  ->whereMonth('month_year', Carbon::parse($selectedMonthYear)->month);
        }])
        ->get()
        ->sum(function ($employee) {
            return $employee->absent->sum('incentive_amount');
        });
    }

    public function getTotalKebersihanAttribute()
    {
        $selectedMonthYear = request()->query('selectedMonthYear', Carbon::now()->format('Y-m'));
    
        return $this->employeeMaster()
            ->with(['clean' => function ($query) use ($selectedMonthYear) {
                $query->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%');
            }, 'vendors'])
            ->get()
            ->sum(function ($employee) {
                $totalKebersihan = 0;
    
                foreach ($employee->clean as $value) {
                    if ($value->total > 3) {
                        $totalKebersihan += $value->bonus_penalty;
                    } else {
                        $totalKebersihan -= $value->bonus_penalty;
                    }
                }
    
                return $totalKebersihan;
            });
    }
    
    public function getTotalSlaAttribute()
    {
        $selectedMonthYear = request()->query('selectedMonthYear', Carbon::now()->format('Y-m'));
        
        return $this->employeeMaster()
            ->with(['sla' => function ($query) use ($selectedMonthYear) {
                $query->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%');
            }])
            ->get()
            ->sum(function ($employee) {
                $totalSLA = 0;

                // Filter sudah dilakukan di database, jadi langsung dihitung di PHP
                foreach ($employee->sla as $value) {
                    if ($value->total >= 80) {
                        $totalSLA += $value->total_sla;
                    } else {
                        $totalSLA -= $value->total_sla;
                    }
                }

                return $totalSLA;
            });
    }


    public function getTotalBbmAttribute()
    {
        $selectedMonthYear = request()->query('selectedMonthYear', Carbon::now()->format('Y-m'));
        
        return $this->employeeMaster()
            ->with(['bbm' => function ($query) use ($selectedMonthYear) {
                $query->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%');
            }, 'vendors'])
            ->get()
            ->sum(function ($employee) {
                $totalBBM = 0;
    
                // Menghitung totalBBM berdasarkan vendor dan data bbm yang sudah difilter
                foreach ($employee->vendors as $vendor) {
                    // Ambil data bbm untuk setiap vendor yang sudah difilter
                    $bbm = $employee->bbm->where('vendor_id', $vendor->id)->first();
    
                    if ($bbm) {
                        $totalBBM += $bbm->total;
                    }
                }
    
                return $totalBBM;
            });
    }
    

    public function getTotalRetribusiAttribute()
    {
        $selectedMonthYear = request()->query('selectedMonthYear', Carbon::now()->format('Y-m'));

        return $this->employeeMaster()
            ->with(['retribution' => function ($query) use ($selectedMonthYear) {
                $query->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%');
            }, 'vendors'])
            ->get()
            ->sum(function ($employee) {
                $totalRetribusi = 0;

                // Menghitung totalRetribusi berdasarkan vendor dan data retribution yang sudah difilter
                foreach ($employee->vendors as $vendor) {
                    // Ambil data retribution untuk setiap vendor yang sudah difilter
                    $retribution = $employee->retribution->where('vendor_id', $vendor->id)->first();

                    if ($retribution) {
                        $totalRetribusi += $retribution->total;
                    }
                }

                return $totalRetribusi;
            });
    }

    public function getTotalInsentifAttribute()
    {
        $selectedMonthYear = request()->query('selectedMonthYear', Carbon::now()->format('Y-m'));
    
        return $this->employeeMaster()
            ->with(['insentif' => function ($query) use ($selectedMonthYear) {
                $query->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%');
            }, 'vendors'])
            ->get()
            ->sum(function ($employee) {
                $totalInsentif = 0;
    
                // Menghitung totalInsentif berdasarkan vendor dan data insentif yang sudah difilter
                foreach ($employee->vendors as $vendor) {
                    // Ambil data insentif untuk setiap vendor yang sudah difilter
                    $insentif = $employee->insentif->where('vendor_id', $vendor->id)->first();
    
                    if ($insentif) {
                        $totalInsentif += $insentif->total;
                    }
                }
    
                return $totalInsentif;
            });
    }

    public function getTotalLainnyaAttribute()
    {
        $selectedMonthYear = request()->query('selectedMonthYear', Carbon::now()->format('Y-m'));
    
        return $this->employeeMaster()
            ->with(['lainya' => function ($query) use ($selectedMonthYear) {
                $query->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%');
            }, 'vendors'])
            ->get()
            ->sum(function ($employee) {
                $totalLainnya = 0;
    
                foreach ($employee->vendors as $vendor) {
                    // Ambil data lainnya berdasarkan employee, vendor, dan selectedMonthYear
                    $lainnya = $employee->lainya->where('vendor_id', $vendor->id)->first();
    
                    if ($lainnya) {
                        $totalLainnya += $lainnya->total;
                    }
                }
    
                return $totalLainnya;
            });
    }
    

    public function getTotalPreviousAttribute()
    {
        $selectedMonthYear = request()->query('selectedMonthYear', Carbon::now()->format('Y-m'));
    
        return $this->employeeMaster()
            ->with(['previous' => function ($query) use ($selectedMonthYear) {
                $query->where('month_year', 'like', Carbon::parse($selectedMonthYear)->format('Y-m') . '%');
            }, 'vendors'])
            ->get()
            ->sum(function ($employee) {
                $totalPrevious = 0;
    
                foreach ($employee->vendors as $vendor) {
                    // Ambil data previous berdasarkan employee, vendor, dan selectedMonthYear
                    $previous = $employee->previous->where('vendor_id', $vendor->id)->first();
    
                    if ($previous) {
                        $totalPrevious += $previous->total;
                    }
                }
    
                return $totalPrevious;
            });
    }

    public function getTotalBpjsAttribute()
    {
        return $this->employeeMaster()
            ->with(['bpjs', 'vendors'])
            ->get()
            ->sum(function ($employee) {
                $totalBpjs = 0;
    
                foreach ($employee->vendors as $vendor) {
                    // Ambil data BPJS berdasarkan vendor
                    $bpjs = $employee->bpjs->first();
    
                    if ($bpjs) {
                        $totalBpjs += $bpjs->total_bpjs; 
                    }
                }
    
                return $totalBpjs;
            });
    }

    
    
    
}

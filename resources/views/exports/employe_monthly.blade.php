<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Employee</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h1>Payroll {{ $selectedMonthYear }}</h1>

    <table>
        <thead>
            <tr>
                <th>
                    Vendor
                </th>
                <th>
                    Client
                </th>
                <th>
                    Join Date
                </th>
                <th>
                    Resign Date
                </th>
                <th>
                    Client
                </th>
                <th>
                    Status+Area
                </th>
                <th>
                    NIK
                </th>
                <th>
                    Name
                </th>
                <th>
                    Area
                </th>
                <th>
                    Total Gaji Pokok
                </th>
                <th>
                    Lembur
                </th>
                <th>
                    Uang Standby
                </th>
                <th>
                    Uang Makan
                </th>
                <th>
                    Uang MEL
                </th>
                <th>
                    Uang Unit
                </th>
                <th>
                    Uang Loading
                </th>
                <th>
                    Bonus Kehadiran
                </th>
                <th>
                    Bonus/Denda Kebersihan 
                </th>
                <th>
                    Bonus/Denda SLA
                </th>
                <th>
                    Bonus/Denda BBM
                </th>
                <th>
                    Retribusi
                </th>
                <th>
                    Insentif Tomorow
                </th>
                <th>
                    Lain-lain
                </th>
                <th>
                    Selisih Bulan Lalu
                </th>
                <th>
                    JHT
                </th>
                <th>
                    JKK
                </th>
                <th>
                    JKM
                </th>
                <th>
                    JP
                </th>
                <th>
                    KES
                </th>
                <th>
                    Total BPJS
                </th>
                <th>
                    Potongan Gaji
                </th>
                <th>
                    Total Budget
                </th>
                <th>
                    Mg. Fee
                </th>
                <th>
                    PPN 11%
                </th>
                <th>
                    PPh 23 / Final
                </th>
                <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                    TOTAL INVOICE
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $key => $value)
                    @php
                        if ($value->client == 'Security' || $value->client == 'Office Boy') {
                        $salary = $value->area->umk;
                        } else {
                            // Driver
                            if ($value->area->umk >= 4000000) {
                                $salary = $value->area->umk * 0.80; // Jika UMK di atas 4.000.000, dikali 80%
                            } else {
                                $salary = $value->area->umk * 0.90; // Jika UMK di bawah 4.000.000, dikali 90%
                            }
                        }
                        if ($value->status == 3) {
                            $calt = $value->absent->where('month_year',$selectedMonthYear . '-01')->where('status',$value->status)->sum('absent');
                            // dd($calt, $$value->area->total_harian);
                            $salary = ($value->area->total_harian * $calt) ?? $value->area->total_harian;
                        } else {
                            // Driver
                            if ($value->area->umk >= 4000000) {
                                $salary = $value->area->umk * 0.80; // Jika UMK di atas 4.000.000, dikali 80%
                            } else {
                                $salary = $value->area->umk * 0.90; // Jika UMK di bawah 4.000.000, dikali 90%
                            }
                        }
                        $perMonth = $value->absent->where('status', $value->status)->first()?->total_days_in_month['total_month_employee'] ?? 00;
                        $absentEmployee = $value->absent->where('month_year',$selectedMonthYear . '-01')->where('status', $value->status)->sum('absent');
                        // dd($absentEmployee, $perMonth);
                        $totalSalary = ($salary/$perMonth)*$absentEmployee;

                        $totalLembur = $value->lembur
                        ->where('month_year',$selectedMonthYear . '-01')
                        ->where('status', $value->status)
                        ->sum('total');

                        $totalStand = $value->stand
                        ->where('month_year',$selectedMonthYear . '-01')
                        ->where('status', $value->status)
                        ->sum('total');

                        $totalMakan = $value->makan
                        ->where('month_year',$selectedMonthYear . '-01')
                        ->where('status', $value->status)
                        ->sum('total');

                        $totalMEL = $value->makan
                        ->where('month_year',$selectedMonthYear . '-01')
                        ->where('status', $value->status)
                        ->sum('total_mel');

                        $totalUNIT = $value->makan
                        ->where('month_year',$selectedMonthYear . '-01')
                        ->where('status', $value->status)
                        ->sum('total_unit');

                        $totalLOADING = $value->makan
                        ->where('month_year',$selectedMonthYear . '-01')
                        ->where('status', $value->status)
                        ->sum('total_loading');

                        $totalAbsent = $value->absent
                        ->where('month_year',$selectedMonthYear . '-01')
                        ->where('status', $value->status)
                        ->sum('incentive_amount');

                              
                $employeeClean = $value->clean->where('month_year', $selectedMonthYear . '-01')->where('status', $value->status);
                $employeeSLA = $value->sla->where('month_year', $selectedMonthYear . '-01')->where('status', $value->status);

                $totalClean = 0; 
                foreach ($employeeClean as $clean) {
                    if ($clean->total > 3) {
                        $totalClean += $clean->bonus_penalty;
                    } else {
                        $totalClean -= $clean->bonus_penalty;
                    }
                }

                $totalSLA = 0;
                foreach ($employeeSLA as $sla) {
                    if ($sla->total  >= 80) {
                        $totalSLA += $sla->total_sla;
                    } else {
                        $totalSLA -= $sla->total_sla;
                    }
                }

                if (in_array($value->status, [2, 3])) {
                    $totalBBM = 0;
                } else {
                    $totalBBM = $value->bbm
                        ->where('month_year', $selectedMonthYear . '-01')
                        ->where('status', $value->status)
                        ->sum('total');
                }             
                if (in_array($value->status, [2, 3])) {
                    $totalRetri = 0;
                } else {
                    $totalRetri = $value->retribution
                        ->where('status', $value->status)
                        ->sum('total');
                }

                $totalInsentif = $value->insentif
                ->where('month_year',$selectedMonthYear . '-01')
                ->where('status', $value->status)
                ->sum('total');

                $totalLainya = $value->lainya
                ->where('month_year',$selectedMonthYear . '-01')
                ->where('status', $value->status)
                ->sum('total');

                $totalPrev = $value->previous
                ->where('month_year',$selectedMonthYear . '-01')
                ->where('status', $value->status)
                ->sum('total');

                $calculate1 = $salary+$totalLembur+$totalStand+$totalMakan+$totalMEL+$totalUNIT+$totalLOADING+$totalAbsent; 
                $calculate2 = 0;
                $calculate3 = 0;
                foreach ($employeeClean as $clean) {
                    if ($clean->total > 3) {
                        $cleanTotal = $clean->total;
                        $calculate2 = $calculate1+$totalClean;
                    } else {
                        $cleanTotal = '-' . $clean->total;
                        $calculate2 = $calculate1-$totalClean;
                    }
                }
                if ($calculate2 == 0) {
                    $calculate2 = $calculate1;
                }
                
                foreach ($employeeSLA as $sla) {
                    if ($sla->total  >= 80) {
                        $slaTotal = $sla->total;
                        $calculate3 = $calculate2+$totalSLA;
                    } else {
                        $slaTotal = '-' .$sla->total;
                        $calculate3 = $calculate2-$totalSLA;
                    }
                }
                @endphp
                <tr>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->client }}</td>
                    <td>{{ $value->join_date ? \Carbon\Carbon::parse($value->join_date)->format('M d, Y') : '-' }}</td>
                    <td>{{ $value->resign_date ? \Carbon\Carbon::parse($value->resign_date)->format('M d, Y') : '-' }}</td>
                    <td>{{ $value->client }}</td>
                    <td>{{ $value->status_name . $value->area->area }}</td>
                    <td>{{ $value->nik }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->area->area }}</td>
                    <td>{{ $totalSalary }}</td>
                    <td> {{ $totalLembur }}</td>
                    <td> {{ $totalStand  }}</td>
                    <td>   {{ $totalMakan }} </td>
                    <td>  {{ $totalMEL }}</td>
                    <td> {{ $totalUNIT }}</td>
                    <td>  {{ $totalLOADING }}</td>
                    <td> {{ $totalAbsent  }} </td>
                    <td> 
                        @php
                        $totalClean = 0; 
                        foreach ($value->clean->where('month_year',$selectedMonthYear . '-01')->where('status', $value->status) as $clean) {
                            if ($clean->total > 3) {
                                $totalClean += $clean->bonus_penalty;
                            } else {
                                $totalClean -= $clean->bonus_penalty;
                            }
                        }
                        @endphp
                      
                        {{ $totalClean }}</td>
                    <td> 
                        @php
                        $totalSLA = 0;
                        foreach ($value->sla->where('month_year',$selectedMonthYear . '-01')->where('status', $value->status) as $sla) {
                            if ($sla->total  >= 80) {
                                $totalSLA += $sla->total_sla;
                            } else {
                                $totalSLA -= $sla->total_sla;
                            }
                        }
                        @endphp
                         {{ $totalSLA }}                                         
                    </td>
                    <td> {{ $totalBBM }} </td>
                    <td>{{ $totalRetri }} </td>
                    <td>  {{ $totalInsentif }}</td>
                    <td>  {{ $totalLainya }}</td>
                    <td> {{ $totalPrev }}</td>

                    <td>
                        {{ $value->bpjs->jht ?? 0 }}
                    </td>
                    <td>
                        {{ $value->bpjs->jkk ?? 0 }}
                    </td>
                    <td>
                        {{ $value->bpjs->jkm ?? 0 }}
                    </td>
                    <td>
                        {{ $value->bpjs->jp ?? 0 }}
                    </td>
                    <td>
                        {{ $value->bpjs->kes ?? 0 }}
                    </td>
                    <td>
                        {{ optional($value->bpjs)->total_bpjs ?? 0 }}
                    </td>
                    <td>
                      0
                    </td>
                    <td>
                        @php
                        $calculate1 = $totalSalary+$totalLembur+$totalStand+$totalMakan+$totalMEL+$totalUNIT+$totalLOADING+$totalAbsent; 
                        $calculate2 = 0;
                        $calculate3 = 0;
                        foreach ($value->clean->where('month_year',$selectedMonthYear . '-01')->where('status', $value->status) as $clean) {
                            if ($clean->total > 3) {
                                $calculate2 = $calculate1+$totalClean;
                            } else {
                                $calculate2 = $calculate1-$totalClean;
                            }
                        }
                        if ($calculate2 == 0) {
                            $calculate2 = $calculate1;
                        }
                        
                        foreach ($value->sla->where('month_year',$selectedMonthYear . '-01')->where('status', $value->status) as $sla) {
                            if ($sla->total  >= 80) {
                                $calculate3 = $calculate2+$totalSLA;
                            } else {
                                $calculate3 = $calculate2-$totalSLA;
                            }
                        }
                        if($calculate3 == 0){
                            $calculate3 = $calculate2;
                        }

                        $calculate4 = $calculate3+$totalBBM+$totalRetri+$totalInsentif+$totalLainya+$totalPrev;
                        $calculated5 = $calculate4+optional($value->bpjs)->total_bpjs ?? 0;
                        @endphp
                            {{ $calculated5 }}
                    </td>
                    <td>
                        @php
                             $mgFee = $calculated5 * 0.05;
                            $ppn = $mgFee * 0.11;
                            $pph = 0.02 * $mgFee;
                            $totalInvoice = $calculated5+$mgFee+$ppn+$pph;
                            @endphp
                            {{ $mgFee }}
                    </td>
                    <td>
                        {{ $ppn }}
                    </td>
                    <td>
                        {{ $ppn }}
                    </td>
                    <td>
                        {{ $totalInvoice }}

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

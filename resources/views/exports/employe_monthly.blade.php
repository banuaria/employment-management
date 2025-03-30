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
            @foreach($employees as $employee)
                @foreach ($employee->vendors as $key => $value)
                    @php
                        if ($employee->client == 'Security' || $employee->client == 'Office Boy') {
                        $salary = $employee->area->umk;
                        } else {
                            // Driver
                            if ($employee->area->umk >= 4000000) {
                                $salary = $employee->area->umk * 0.80; // Jika UMK di atas 4.000.000, dikali 80%
                            } else {
                                $salary = $employee->area->umk * 0.90; // Jika UMK di bawah 4.000.000, dikali 90%
                            }
                        }
                        if ($employee->status == 'HARIAN') {
                            $calt = $employee->absent->where('month_year',$selectedMonthYear . '-01')->where('vendor_id', $value->id)->sum('absent');
                            // dd($calt, $$employee->area->total_harian);
                            $salary = ($employee->area->total_harian * $calt) ?? $employee->area->total_harian;
                        } else {
                            // Driver
                            if ($employee->area->umk >= 4000000) {
                                $salary = $employee->area->umk * 0.80; // Jika UMK di atas 4.000.000, dikali 80%
                            } else {
                                $salary = $employee->area->umk * 0.90; // Jika UMK di bawah 4.000.000, dikali 90%
                            }
                        }

                        $totalLembur = $employee->lembur
                        ->where('month_year',$selectedMonthYear . '-01')
                        ->where('vendor_id', $value->id)
                        ->sum('total');

                        $totalStand = $employee->stand
                        ->where('month_year',$selectedMonthYear . '-01')
                        ->where('vendor_id', $value->id)
                        ->sum('total');

                        $totalMakan = $employee->makan
                        ->where('month_year',$selectedMonthYear . '-01')
                        ->where('vendor_id', $value->id)
                        ->sum('total');

                        $totalMEL = $employee->makan
                        ->where('month_year',$selectedMonthYear . '-01')
                        ->where('vendor_id', $value->id)
                        ->sum('total_mel');

                        $totalUNIT = $employee->makan
                        ->where('month_year',$selectedMonthYear . '-01')
                        ->where('vendor_id', $value->id)
                        ->sum('total_unit');

                        $totalLOADING = $employee->makan
                        ->where('month_year',$selectedMonthYear . '-01')
                        ->where('vendor_id', $value->id)
                        ->sum('total_loading');

                        $totalAbsent = $employee->absent
                        ->where('month_year',$selectedMonthYear . '-01')
                        ->where('vendor_id', $value->id)
                        ->sum('incentive_amount');

                              
                $employeeClean = $employee->clean->where('month_year', $selectedMonthYear . '-01')->where('vendor_id', $value->id);
                $employeeSLA = $employee->sla->where('month_year', $selectedMonthYear . '-01')->where('vendor_id', $value->id);

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

                $totalBBM = $employee->bbm
                ->where('month_year',$selectedMonthYear . '-01')
                ->where('vendor_id', $value->id)
                ->sum('total');

                $totalRetri = $employee->retribution
                ->where('month_year',$selectedMonthYear . '-01')
                ->where('vendor_id', $value->id)
                ->sum('total');

                $totalInsentif = $employee->insentif
                ->where('month_year',$selectedMonthYear . '-01')
                ->where('vendor_id', $value->id)
                ->sum('total');

                $totalLainya = $employee->lainya
                ->where('month_year',$selectedMonthYear . '-01')
                ->where('vendor_id', $value->id)
                ->sum('total');

                $totalPrev = $employee->previous
                ->where('month_year',$selectedMonthYear . '-01')
                ->where('vendor_id', $value->id)
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
                // if($calculate3 == 0){
                //     $calculate3 = $calculate2;
                // }

                // $calculate4 = $calculate3+$totalBBM+$totalRetri+$totalInsentif+$totalLainya+$totalPrev;
                // $calculate5 = $calculate4+$employee->bpjs->total_bpjs;

                // $mgFee = $calculate5 * 0.05;
                // $ppn = $mgFee * 0.11;
                // $pph = 0.02 * $mgFee;
                // $totalInvoice = $calculate5 + $mgFee + $ppn + $pph;
                @endphp
                <tr>
                    <td>{{ $value->name }}</td>
                    <td>{{ $employee->client }}</td>
                    <td>{{ $employee->join_date ? \Carbon\Carbon::parse($employee->join_date)->format('M d, Y') : '-' }}</td>
                    <td>{{ $employee->resign_date ? \Carbon\Carbon::parse($employee->resign_date)->format('M d, Y') : '-' }}</td>
                    <td>{{ $employee->client }}</td>
                    <td>{{ $employee->status . $employee->area->area }}</td>
                    <td>{{ $employee->nik }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->area->area }}</td>
                    <td>{{ $salary }}</td>
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
                        foreach ($employee->clean->where('month_year',$selectedMonthYear . '-01')->where('vendor_id', $value->id) as $clean) {
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
                        foreach ($employee->sla->where('month_year',$selectedMonthYear . '-01')->where('vendor_id', $value->id) as $sla) {
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
                        {{ $employee->bpjs->jht }}
                    </td>
                    <td>
                        {{ $employee->bpjs->jkk }}
                    </td>
                    <td>
                        {{ $employee->bpjs->jkm }}
                    </td>
                    <td>
                        {{ $employee->bpjs->jp }}
                    </td>
                    <td>
                        {{ $employee->bpjs->kes }}
                    </td>
                    <td>
                        {{ $employee->bpjs->total_bpjs }}
                    </td>
                    <td>
                      0
                    </td>
                    <td>
                        @php
                        $calculate1 = $salary+$totalLembur+$totalStand+$totalMakan+$totalMEL+$totalUNIT+$totalLOADING+$totalAbsent; 
                        $calculate2 = 0;
                        $calculate3 = 0;
                        foreach ($employee->clean->where('month_year',$selectedMonthYear . '-01')->where('vendor_id', $value->id) as $clean) {
                            if ($clean->total > 3) {
                                $calculate2 = $calculate1+$totalClean;
                            } else {
                                $calculate2 = $calculate1-$totalClean;
                            }
                        }
                        if ($calculate2 == 0) {
                            $calculate2 = $calculate1;
                        }
                        
                        foreach ($employee->sla->where('month_year',$selectedMonthYear . '-01')->where('vendor_id', $value->id) as $sla) {
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
                        $calculated5 = $calculate4+$employee->bpjs->total_bpjs;
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
            @endforeach
        </tbody>
    </table>
</body>
</html>

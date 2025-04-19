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
    <table>
        <thead>
            <tr>
                <th>
                    Gateway
                </th>
                <th>
                    Gaji Pokok
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
                    Insentif Tomoro
                </th>
                <th>
                    Lain-lain
                </th>
                <th>
                    Selisih Bulan Lalu
                </th>
                <th>
                    BPJS
                </th>
                <th>
                    TOTAL SALARY
                </th>
                <th>
                    Management Fee
                </th>
                <th>
                    PPN 11%
                </th>
                <th>
                    PPH 23 / Final
                </th>
                <th>
                    TOTAL INVOICE
                </th>
            </tr>
        </thead>
        <tbody>
            @php
            // Inisialisasi variabel total akumulasi di luar loop
            $grandAreaTotalSalary = 0;
            $grandTotalLembur = 0;
            $grandTotalStand = 0;
            $grandTotalMakan = 0;
            $grandTotalMel = 0;
            $grandTotalUnit = 0;
            $grandTotalLoading = 0;
            $grandTotalBonusKehadiran = 0;
            $grandTotalKebersihan = 0;
            $grandTotalSla = 0;
            $grandTotalBbm = 0;
            $grandTotalRetribusi = 0;
            $grandTotalInsentif = 0;
            $grandTotalLainnya = 0;
            $grandTotalPrevious = 0;
            $grandTotalBpjs = 0;
            $grandTotalSalary = 0;
            $grandMgFee = 0;
            $grandPpn = 0;
            $grandPph = 0;
            $grandTotalInvoice = 0;
        @endphp
        @if (!empty($summary) && count($summary) > 0)
            @foreach ($summary as $key => $value)
            @php
                $areaTotalSalary = 0; 
                $totalLembur = 0;
                $totalStand = 0;
                $totalMakan = 0;
                $totalMel = 0;
                $totalUnit = 0;
                $totalLoading = 0;
                $totalBonusKehadiran = 0;
                $totalKebersihan = 0;
                $totalSla = 0;
                $totalBbm = 0;
                $totalRetribusi = 0;
                $totalInsentif = 0;
                $totalLainnya = 0;
                $totalPrevious = 0;
                $totalBpjs = 0;

                    foreach ($value->employeeMaster as $employee) {
                        $salary = 0;
                        $totalSalary = 0;

                        $umk = $employee->area->umk;
                        $totalHarian = $employee->area->total_harian;

                        // Gaji dasar berdasarkan client
                        if ($employee->client == 'SECURITY' || $employee->client == 'OFFICE BOY') {
                            $salary = $umk;
                        } else {
                            $salary = $umk >= 4000000 ? $umk * 0.80 : $umk * 0.90;
                        }

                        // Jika status harian
                        if ($employee->status == 3) {
                            $absenHarian = $employee->absent
                                ->where('month_year', $selectedMonthYear . '-01')
                                ->where('status', $employee->status)
                                ->sum('absent');

                            $salary = ($totalHarian * $absenHarian) ?? $totalHarian;
                        }

                        // Hitung hari kerja dan absen
                        $perMonth = $employee->absent
                            ->where('status', $employee->status)
                            ->first()?->total_days_in_month['total_month_employee'] ?? 0;

                        $absentEmployee = $employee->absent
                            ->where('month_year', $selectedMonthYear . '-01')
                            ->where('status', $employee->status)
                            ->sum('absent');

                        $totalSalary = ($perMonth > 0) ? ($salary / $perMonth) * $absentEmployee : 0;
                        $areaTotalSalary += $totalSalary;

                        // Tambahan lainnya
                        $totalLembur += $employee->lembur->sum('total');
                        $totalStand += $employee->stand->sum('total');
                        $totalMakan += $employee->makan->sum('total');
                        $totalMel += $employee->makan->sum('total_mel');
                        $totalUnit += $employee->makan->sum('total_unit');
                        $totalLoading += $employee->makan->sum('total_loading');

                        $bonus = $employee->absent
                            ->where('month_year', $selectedMonthYear . '-01')
                            ->where('status', $employee->status)
                            ->sum('incentive_amount');
                        $totalBonusKehadiran += $bonus;

                        foreach ($employee->clean->where('month_year', $selectedMonthYear . '-01') as $clean) {
                            $totalKebersihan += ($clean->total > 3)
                                ? $clean->bonus_penalty
                                : -$clean->bonus_penalty;
                        }
                        foreach ($employee->sla->where('month_year', $selectedMonthYear . '-01') as $sla) {
                            if ($sla->total >= 80) {
                                $totalSla += $sla->total_sla;
                            } else {
                                $totalSla -= $sla->total_sla;
                            }
                        }

                        if (in_array($employee->status, [2, 3])) {
                                $totalBBM = 0;
                            } else {
                                $totalBBM = $employee->bbm
                                    ->where('month_year', $selectedMonthYear . '-01')
                                    ->where('status', $employee->status)
                                    ->sum('total');
                            }
                        $totalBbm += $totalBBM;    
                        
                        $totalRetribusi += $employee->retribution
                            ->where('month_year', $selectedMonthYear . '-01')
                            ->where('status', $employee->status)
                            ->sum('total');

                        $totalInsentif += $employee->insentif->where('month_year',$selectedMonthYear . '-01')
                                ->where('status', $value->status)
                                ->sum('total');

                        $totalLainnya += $employee->lainya
                            ->where('month_year', $selectedMonthYear . '-01')
                            ->where('status', $employee->status)
                            ->sum('total');

                        $totalPrevious += $employee->previous->where('month_year',$selectedMonthYear . '-01')
                                ->where('status', $employee->status)
                                ->sum('total');
                        
                        $totalBpjs += $employee->bpjs->total_bpjs;
                    }
                    $totalSalary = $areaTotalSalary + $totalLembur + $totalStand + $totalMakan + $totalMel + $totalUnit + $totalLoading + $totalBonusKehadiran + $totalKebersihan + $totalSla + $totalBbm + $totalRetribusi + $totalInsentif + $totalLainnya + $totalPrevious + $totalBpjs;

                    $mgFee = $totalSalary * 0.05;
                    $ppn = $mgFee * 0.11;
                    $pph = $totalSalary * 0.2;
                    $totalInvoice = $totalSalary + $mgFee + $ppn + $pph;
                    $grandAreaTotalSalary += $areaTotalSalary;

                    $grandTotalLembur += $totalLembur;
                    $grandTotalStand += $totalStand;
                    $grandTotalMakan += $totalMakan;
                    $grandTotalMel += $totalMel;
                    $grandTotalUnit += $totalUnit;
                    $grandTotalLoading += $totalLoading;
                    $grandTotalBonusKehadiran += $totalBonusKehadiran;
                    $grandTotalKebersihan += $totalKebersihan;
                    $grandTotalSla += $totalSla;
                    $grandTotalBbm += $totalBbm;
                    $grandTotalRetribusi += $totalRetribusi;
                    $grandTotalInsentif += $totalInsentif;
                    $grandTotalLainnya += $totalLainnya;
                    $grandTotalPrevious += $totalPrevious;
                    $grandTotalBpjs += $totalBpjs;
                    $grandTotalSalary += $totalSalary;
                    $grandMgFee += $mgFee;
                    $grandPpn += $ppn;
                    $grandPph += $pph;
                    $grandTotalInvoice += $totalInvoice;
                @endphp
                <tr class="bg-white border-b">
                    <td class="px-4 py-3 border-r">{{ $value->area }}</td>
                    <td class="px-4 py-3 border-r">{{ $areaTotalSalary}}</td>
                    <td class="px-4 py-3 border-r">{{ $totalLembur}}</td>
                    <td class="px-4 py-3 border-r">{{ $totalStand}}</td>
                    <td class="px-4 py-3 border-r">{{ $totalMakan}}</td>
                    <td class="px-4 py-3 border-r">{{ $totalMel}}</td>
                    <td class="px-4 py-3 border-r">{{ $totalUnit}}</td>
                    <td class="px-4 py-3 border-r">{{ $totalLoading}}</td>
                    <td class="px-4 py-3 border-r">{{ $totalBonusKehadiran}}</td>
                    <td class="px-4 py-3 border-r">{{ $totalKebersihan}}</td>
                    <td class="px-4 py-3 border-r">{{ $totalSla}}</td>
                    <td class="px-4 py-3 border-r">{{ $totalBbm}}</td>
                    <td class="px-4 py-3 border-r">{{ $totalRetribusi}}</td>
                    <td class="px-4 py-3 border-r">{{ $totalInsentif}}</td>
                    <td class="px-4 py-3 border-r">{{ $totalLainnya}}</td>
                    <td class="px-4 py-3 border-r">{{ $totalPrevious}}</td>
                    <td class="px-4 py-3 border-r">{{ $totalBpjs}}</td>
                    <td class="px-4 py-3 border-r">
                        {{ $totalSalary}}
                    </td>
                    <td class="px-4 py-3 border-r">
                        {{ $mgFee}}
                    </td>
                    <td class="px-4 py-3 border-r">
                        {{ $ppn}}
                    </td>
                    <td class="px-4 py-3 border-r">
                        {{ $pph}}
                    </td>
                    <td class="px-4 py-3 border-r">
                        {{ $totalInvoice}}
                    </td>
                </tr>
            @endforeach
                {{-- Row Total Akumulasi --}}
                <tr class="bg-gray-200 font-bold">
                <td class="px-4 py-3 border-r text-center">Total</td>
                <td class="px-4 py-3 border-r">{{ $grandAreaTotalSalary}}</td>
                <td class="px-4 py-3 border-r">{{ $grandTotalLembur}}</td>
                <td class="px-4 py-3 border-r">{{ $grandTotalStand}}</td>
                <td class="px-4 py-3 border-r">{{ $grandTotalMakan}}</td>
                <td class="px-4 py-3 border-r">{{ $grandTotalMel}}</td>
                <td class="px-4 py-3 border-r">{{ $grandTotalUnit}}</td>
                <td class="px-4 py-3 border-r">{{ $grandTotalLoading}}</td>
                <td class="px-4 py-3 border-r">{{ $grandTotalBonusKehadiran}}</td>
                <td class="px-4 py-3 border-r">{{ $grandTotalKebersihan}}</td>
                <td class="px-4 py-3 border-r">{{ $grandTotalSla}}</td>
                <td class="px-4 py-3 border-r">{{ $grandTotalBbm}}</td>
                <td class="px-4 py-3 border-r">{{ $grandTotalRetribusi}}</td>
                <td class="px-4 py-3 border-r">{{ $grandTotalInsentif}}</td>
                <td class="px-4 py-3 border-r">{{ $grandTotalLainnya}}</td>
                <td class="px-4 py-3 border-r">{{ $grandTotalPrevious}}</td>
                <td class="px-4 py-3 border-r">{{ $grandTotalBpjs}}</td>
                <td class="px-4 py-3 border-r">{{ $grandTotalSalary}}</td>
                <td class="px-4 py-3 border-r">{{ $grandMgFee}}</td>
                <td class="px-4 py-3 border-r">{{ $grandPpn}}</td>
                <td class="px-4 py-3 border-r">{{ $grandPph}}</td>
                <td class="px-4 py-3 border-r">{{ $grandTotalInvoice}}</td>
            </tr>
            {{-- End Row Total Akumulasi --}}
        @else
            <tr>
                <td class="px-6 py-3 border text-center whitespace-nowrap" colspan="18">No data found</td>
            </tr>
        @endif
        </tbody>
    </table>
</body>
</html>

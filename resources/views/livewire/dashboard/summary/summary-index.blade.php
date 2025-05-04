<div class="py-12">
    <div class="sm:px-6 lg:px-8">
        <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
            <div class="w-full">
                <div class="flex justify-between items-center space-x-4 mb-4">
                    <div>
                        <button wire:click="export" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">Export</button>
                    </div>
                    <div class="flex-1 flex flex-col sm:flex-row justify-end items-end space-x-0 sm:space-x-2 space-y-2 sm:space-y-0">
                        <div class="relative w-full max-w-480">
                            <div class="flex items-center space-x-2">
                                <input type="month" id="filterDate" wire:model.live.debounce.250ms="monthView" class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Gateway
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Gaji Pokok
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Lembur
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Uang Standby
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Uang Makan
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Uang MEL
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Uang Unit
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Uang Loading
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Bonus Kehadiran
                                    </th>
                                    
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Bonus/Denda Kebersihan
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Bonus/Denda SLA
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Bonus/Denda BBM
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Retribusi
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Insentif Tomoro
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Lain-lain
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Selisih Bulan Lalu
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        BPJS
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        TOTAL SALARY
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Management Fee
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        PPN 11%
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        PPH 23 / Final
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
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
                            @if (count($summary) > 0)
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
                                            }elseif ($value->client == 'All Project'){
                                                $salary = 150000;
                                            }else {
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
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($areaTotalSalary, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($totalLembur, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($totalStand, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($totalMakan, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($totalMel, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($totalUnit, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($totalLoading, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($totalBonusKehadiran, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($totalKebersihan, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($totalSla, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($totalBbm, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($totalRetribusi, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($totalInsentif, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($totalLainnya, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($totalPrevious, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($totalBpjs, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">
                                            {{ 'Rp' . number_format($totalSalary, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3 border-r">
                                            {{ 'Rp' . number_format($mgFee, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3 border-r">
                                            {{ 'Rp' . number_format($ppn, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3 border-r">
                                            {{ 'Rp' . number_format($pph, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3 border-r">
                                            {{ 'Rp' . number_format($totalInvoice, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                                 {{-- Row Total Akumulasi --}}
                                 <tr class="bg-gray-200 font-bold">
                                    <td class="px-4 py-3 border-r text-center">Total</td>
                                    <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($grandAreaTotalSalary, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($grandTotalLembur, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($grandTotalStand, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($grandTotalMakan, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($grandTotalMel, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($grandTotalUnit, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($grandTotalLoading, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($grandTotalBonusKehadiran, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($grandTotalKebersihan, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($grandTotalSla, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($grandTotalBbm, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($grandTotalRetribusi, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($grandTotalInsentif, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($grandTotalLainnya, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($grandTotalPrevious, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($grandTotalBpjs, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($grandTotalSalary, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($grandMgFee, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($grandPpn, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($grandPph, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($grandTotalInvoice, 0, ',', '.') }}</td>
                                </tr>
                                {{-- End Row Total Akumulasi --}}
                            @else
                                <tr>
                                    <td class="px-6 py-3 border text-center whitespace-nowrap" colspan="18">No data found</td>
                                </tr>
                            @endif
                           </tbody>
                        </table>
                    </div>
                    <div wire:loading.delay class="absolute inset-x-0 inset-y-0 w-full h-full bg-gray-50 bg-opacity-50">
                        <div class="w-full h-full flex justify-center items-center">
                            <x-icon-loading class="w-6 h-6 fill-indigo-600 text-gray-200 animate-spin"></x-icon-loading>
                        </div>
                    </div>
                </div>
    {{-- endfile --}}
            </div>
        </div>
    </div>

</div>

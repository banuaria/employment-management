<div class="py-12">
    <div class="sm:px-6 lg:px-8">
        <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
            <div class="w-full">
                <div class="flex justify-between items-center space-x-4 mb-4">
                    <div>
                        {{-- <button wire:click="$dispatch('open-modal', { name: 'create-value-modal' })" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">Create value</button> --}}
                        {{-- <button wire:click="$dispatch('open-modal', { name: 'import-bpjs-modal' })" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">Import</button> --}}
                        <button wire:click="export" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">Export</button>
                    </div>
                    <div class="flex-1 flex flex-col sm:flex-row justify-end items-end space-x-0 sm:space-x-2 space-y-2 sm:space-y-0">
                        <div class="relative w-full max-w-480">
                            <div class="flex items-center space-x-2">
                                <input type="month" id="filterDate" wire:model.live.debounce.250ms="monthView" class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                            </div>
                        </div>
                        <div class="relative w-full max-w-48">
                            <select wire:model.live.debounce.250ms="client" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="" selected>Select Client</option>
                                <option value="Security">Security</option>
                                <option value="Office Boy">Office Boy</option>
                                <option value="Express">Express</option>
                                <option value="All Project">All Project</option>
                                <option value="Cargo">Cargo</option>
                                <option value="Shoppe">Shoppe</option>
                                <option value="Tomoro">Tomoro</option>
                            </select>
                        </div>
                        <div class="relative w-full max-w-48">
                            <select wire:model.live.debounce.250ms="status" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="" selected>Select Status</option>
                                <option value="1">REGULER</option>
                                <option value="2">LOADING</option>
                                <option value="3">HARIAN</option>
                            </select>
                        </div>
                        
                        <div class="relative w-full max-w-48">
                            <select wire:model.live.debounce.250ms="selectedVendor" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="" selected>Select Vendor</option>
                                @foreach ($vendors as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="relative w-full max-w-48">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <x-icon-search-outline class="w-3 h-5 text-gray-500"></x-icon-search-outline>
                            </div>
                            <input
                                wire:model.live.debounce.250ms="search"
                                type="text"
                                class="ps-8 block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Search value"
                            />
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Vendor
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Client
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Join Date
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Resign Date
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Client
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Status+Area
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        NIK
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Name
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Area
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Total Gaji Pokok
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
                                        Insentif Tomorow
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Lain-lain
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Selisih Bulan Lalu
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        JHT
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        JKK
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        JKM
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        JP
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        KES
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Total BPJS
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Potongan Gaji
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Total Budget
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Mg. Fee
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        PPN 11%
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        PPh 23 / Final
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        TOTAL INVOICE
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($employMaster) > 0)
                                    @foreach ($employMaster as $key => $value)
                                        <tr class="bg-white border-b">
                                            @php
                                               if ($value->client == 'All Project') {
                                                    $salary = 150000;
                                                } elseif ($value->client == 'SECURITY' || $value->client == 'OFFICE BOY') {
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
                                                    $calt = $value->absent->where('month_year', $selectedMonthYear . '-01')->where('status', $value->status)->sum('absent');
                                                    $salary = ($value->area->total_harian * $calt) ?? $value->area->total_harian;
                                                } else {
                                                    // Driver
                                                    if ($value->client != 'All Project') { // Jangan timpa jika sudah "All Project"
                                                        if ($value->area->umk >= 4000000) {
                                                            $salary = $value->area->umk * 0.80;
                                                        } else {
                                                            $salary = $value->area->umk * 0.90;
                                                        }
                                                    }
                                                }
                                            $perMonth = $value->absent->where('status', $value->status)->first()?->total_days_in_month['total_month_employee'] ?? 00;
                                            $absentEmployee = $value->absent->where('month_year',$selectedMonthYear . '-01')->where('status', $value->status)->sum('absent');
                                            // dd($absentEmployee, $perMonth);
                                            $totalSalary = ($salary/$perMonth)*$absentEmployee;
                                            // dd($salary,$perMonth,$absentEmployee);
                                            @endphp
                                            <td class="px-4 py-3 border-r">{{ $value->vendors->name }}</td>
                                            <td class="px-4 py-3 border-r">{{ $value->client }}</td>
                                            <td class="px-4 py-3 border-r">{{ $value->join_date ? \Carbon\Carbon::parse( $value->join_date )->translatedFormat('M d, Y') : '-' }}</td>
                                            <td class="px-4 py-3 border-r">{{ $value->resign_date ? \Carbon\Carbon::parse( $value->resign_date )->translatedFormat('M d, Y') : '-'  }}</td>
                                            <td class="px-4 py-3 border-r">{{ $value->client }}</td>
                                            <td class="px-4 py-3 border-r">{{ $value->status_name . $value->area->area }}</td>
                                            <td class="px-4 py-3 border-r">{{ $value->nik }}</td>
                                            <td class="px-4 py-3 border-r">{{ $value->name }}</td>
                                            <td class="px-4 py-3 border-r">{{ $value->area->area }}</td>
                                            <td class="px-4 py-3 border-r"> 
                                                {{ 'Rp' . number_format($totalSalary, 0, ',', '.') }}
                                                {{-- {{$salary .'+'. $perMonth .'+'. $absentEmployee}} --}}
                                            </td>
                                            <td class="px-4 py-3 border-r">
                                                @php
                                                //lembur
                                                    $totalLembur = $value->lembur
                                                        ->where('month_year',$selectedMonthYear . '-01')
                                                        ->where('status', $value->status)
                                                        ->sum('total');
                                                @endphp
                                                    {{ 'Rp' . number_format($totalLembur, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3 border-r"> 
                                                @php
                                                $totalStand = $value->stand->where('month_year',$selectedMonthYear . '-01')
                                                ->where('status', $value->status)
                                                ->sum('total');
                                                @endphp
                                                    {{ 'Rp' . number_format($totalStand, 0, ',', '.')  }}
                                            </td>
                                            <td class="px-4 py-3 border-r">
                                                @php
                                                $totalMakan = $value->makan->where('month_year',$selectedMonthYear . '-01')
                                                        ->where('status', $value->status)
                                                        ->sum('total');
                                                @endphp
                                                {{ 'Rp' . number_format($totalMakan, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3 border-r">
                                                @php
                                                $totalMEL = $value->makan->where('month_year',$selectedMonthYear . '-01')
                                                        ->where('status', $value->status)
                                                        ->sum('total_mel');
                                                @endphp
                                                {{ 'Rp' . number_format($totalMEL, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3 border-r">
                                                @php
                                                $totalUNIT = $value->makan->where('month_year',$selectedMonthYear . '-01')
                                                        ->where('status', $value->status)
                                                        ->sum('total_unit');
                                                @endphp
                                                {{ 'Rp' . number_format($totalUNIT, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3 border-r">
                                                @php
                                                $totalLOADING = $value->makan->where('month_year',$selectedMonthYear . '-01')
                                                        ->where('status', $value->status)
                                                        ->sum('total_loading');
                                                @endphp
                                                {{ 'Rp' . number_format($totalLOADING, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3 border-r"> 
                                                @php
                                                $totalAbsent = $value->absent->where('month_year',$selectedMonthYear . '-01')->where('status', $value->status)->sum('incentive_amount');
                                                @endphp
                                                {{ 'Rp' . number_format($totalAbsent, 0, ',', '.')  }}
                                            </td>
                                            <td class="px-4 py-3 border-r">
                                                @php
                                                $totalClean = 0; 
                                                foreach ($value->clean->where('month_year',$selectedMonthYear . '-01') as $clean) {
                                                    if ($clean->total > 3) {
                                                        $totalClean += $clean->bonus_penalty;
                                                    } else {
                                                        $totalClean -= $clean->bonus_penalty;
                                                    }
                                                }
                                                @endphp
                                                
                                                {{ 'Rp' . number_format($totalClean, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3 border-r">
                                                @php
                                                  $totalSLA = 0;
                                              
                                                foreach ($value->sla->where('month_year',$selectedMonthYear . '-01') as $sla) {
                                                    if ($sla->total  >= 80) {
                                                        $totalSLA += $sla->total_sla;
                                                    } else {
                                                        $totalSLA -= $sla->total_sla;
                                                    }
                                                }
                                                @endphp
                                                    {{ 'Rp' . number_format($totalSLA, 0, ',', '.') }}                                          
                                            </td>
                                            <td class="px-4 py-3 border-r">
                                                @php
                                                  if (in_array($value->status, [2, 3])) {
                                                            $totalBBM = 0;
                                                        } else {
                                                            $totalBBM = $value->bbm
                                                                ->where('month_year', $selectedMonthYear . '-01')
                                                                ->where('status', $value->status)
                                                                ->sum('total');
                                                        }                                         
                                                @endphp
                                                {{ 'Rp' . number_format($totalBBM, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3 border-r">
                                                @php
                                                 if (in_array($value->status, [2, 3])) {
                                                        $totalRetri = 0;
                                                    } else {
                                                        $totalRetri = $value->retribution
                                                            ->where('status', $value->status)
                                                            ->sum('total');
                                                    }
                                                @endphp
                                                {{ 'Rp' . number_format($totalRetri, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3 border-r">
                                                @php
                                                $totalInsentif = $value->insentif->where('month_year',$selectedMonthYear . '-01')
                                                        ->where('status', $value->status)
                                                        ->sum('total');
                                                @endphp
                                                {{ 'Rp' . number_format($totalInsentif, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3 border-r">
                                                @php
                                                $totalLainya = $value->lainya->where('month_year',$selectedMonthYear . '-01')
                                                        ->where('status', $value->status)
                                                        ->sum('total');
                                                @endphp
                                                {{ 'Rp' . number_format($totalLainya, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3 border-r">
                                                @php
                                                $totalPrev = $value->previous->where('month_year',$selectedMonthYear . '-01')
                                                        ->where('status', $value->status)
                                                        ->sum('total');
                                                @endphp
                                                {{ 'Rp' . number_format($totalPrev, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3 border-r">
                                                {{ 'Rp' . number_format($value->bpjs->jht ?? 0, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3 border-r">
                                                {{ 'Rp' . number_format($value->bpjs->jkk ?? 0, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3 border-r">
                                                {{ 'Rp' . number_format($value->bpjs->jkm ?? 0, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3 border-r">
                                                {{ 'Rp' . number_format($value->bpjs->jp ?? 0, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3 border-r">
                                                {{ 'Rp' . number_format($value->bpjs->kes ?? 0, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3 border-r">
                                                {{ 'Rp' . number_format(optional($value->bpjs)->total_bpjs ?? 0, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3 border-r">
                                                0
                                            </td>
                                            <td class="px-4 py-3 border-r">
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
                                                    {{ 'Rp' . number_format($calculated5, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3 border-r">
                                                @php
                                                    $mgFee = $calculated5 * 0.05;
                                                    $ppn = $mgFee * 0.11;
                                                    $pph = 0.02 * $mgFee;
                                                    $totalInvoice = $calculated5+$mgFee+$ppn+$pph;
                                                @endphp
                                                {{ 'Rp' . number_format($mgFee, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3 border-r">
                                                {{ 'Rp' . number_format($ppn, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3 border-r">
                                                {{ 'Rp' . number_format($ppn, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-3 border-r">

                                                {{ 'Rp' . number_format($totalInvoice, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="bg-white border-b">
                                        <td colspan="100%" class="px-4 py-3 border text-center">No Data</td>
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
                <div class="{{ $employMaster->hasPages() ? 'mt-4' : '' }}">
                    {{ $employMaster->links() }}
                </div>
            </div>
        </div>
    </div>

   
</div>

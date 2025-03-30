<div class="py-12">
    <div class="sm:px-6 lg:px-8">
        <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
            <div class="w-full">
                <div class="flex justify-between items-center space-x-4 mb-4">
                    <div>
                        {{-- <button wire:click="$dispatch('open-modal', { name: 'create-employee-modal' })" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">Create employee</button> --}}
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
                                <option value="REGULER">REGULER</option>
                                <option value="LOADING">LOADING</option>
                                <option value="HARIAN">HARIAN</option>
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
                                placeholder="Search employee"
                            />
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    {{-- <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">No</th> --}}
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
                                    @foreach ($employMaster as $key => $employee)
                                        @foreach ($employee->vendors as $key => $value)
                                            <tr class="bg-white border-b">
                                                {{-- logic --}}
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
                                                @endphp 
                                                {{-- <td class="px-4 py-3 border text-center w-key0"><div class="py-1.5">{{ $employee + 1 }}</div></td> --}}
                                                <td class="px-4 py-3 border-r">{{ $value->name }}</td>
                                                <td class="px-4 py-3 border-r">{{ $employee->client }}</td>
                                                
                                                <td class="px-4 py-3 border-r">{{ $employee->join_date ? \Carbon\Carbon::parse( $employee->join_date )->translatedFormat('M d, Y') : '-' }}</td>
                                                <td class="px-4 py-3 border-r">{{ $employee->resign_date ? \Carbon\Carbon::parse( $employee->resign_date )->translatedFormat('M d, Y') : '-'  }}</td>
                                                <td class="px-4 py-3 border-r">{{ $employee->client }}</td>
                                                <td class="px-4 py-3 border-r">{{ $employee->status . $employee->area->area }}</td>
                                                <td class="px-4 py-3 border-r">{{ $employee->nik }}</td>
                                                <td class="px-4 py-3 border-r">{{ $employee->name }}</td>
                                                <td class="px-4 py-3 border-r">{{ $employee->area->area }}</td>
                                                <td class="px-4 py-3 border-r"> 
                                                    {{ 'Rp' . number_format($salary, 0, ',', '.') }}
                                                </td>
                                                <td class="px-4 py-3 border-r">
                                                    @php
                                                    //lembur
                                                        $totalLembur = $employee->lembur
                                                            ->where('month_year',$selectedMonthYear . '-01')
                                                            ->where('vendor_id', $value->id)
                                                            ->sum('total');
                                                    @endphp
                                                     {{ 'Rp' . number_format($totalLembur, 0, ',', '.') }}
                                                </td>
                                                
                                                <td class="px-4 py-3 border-r"> 
                                                    @php
                                                    $totalStand = $employee->stand->where('month_year',$selectedMonthYear . '-01')
                                                            ->where('vendor_id', $value->id)
                                                            ->sum('total');
                                                    @endphp
                                                        {{ 'Rp' . number_format($totalStand, 0, ',', '.')  }}
                                                </td>
                                               
                                                <td class="px-4 py-3 border-r">
                                                    @php
                                                    $totalMakan = $employee->makan->where('month_year',$selectedMonthYear . '-01')
                                                            ->where('vendor_id', $value->id)
                                                            ->sum('total');
                                                    @endphp
                                                    {{ 'Rp' . number_format($totalMakan, 0, ',', '.') }}
                                                </td>

                                                <td class="px-4 py-3 border-r">
                                                    @php
                                                    $totalMEL = $employee->makan->where('month_year',$selectedMonthYear . '-01')
                                                            ->where('vendor_id', $value->id)
                                                            ->sum('total_mel');
                                                    @endphp
                                                    {{ 'Rp' . number_format($totalMEL, 0, ',', '.') }}
                                                </td>

                                                <td class="px-4 py-3 border-r">
                                                    @php
                                                    $totalUNIT = $employee->makan->where('month_year',$selectedMonthYear . '-01')
                                                            ->where('vendor_id', $value->id)
                                                            ->sum('total_unit');
                                                    @endphp
                                                    {{ 'Rp' . number_format($totalUNIT, 0, ',', '.') }}
                                                </td>

                                                <td class="px-4 py-3 border-r">
                                                    @php
                                                    $totalLOADING = $employee->makan->where('month_year',$selectedMonthYear . '-01')
                                                            ->where('vendor_id', $value->id)
                                                            ->sum('total_loading');
                                                    @endphp
                                                    {{ 'Rp' . number_format($totalLOADING, 0, ',', '.') }}
                                                </td>
                                               
                                                <td class="px-4 py-3 border-r"> 
                                                    @php
                                                    
                                                    $totalAbsent = $employee->absent->where('month_year',$selectedMonthYear . '-01')->where('vendor_id', $value->id)->sum('incentive_amount');
                                                    @endphp
                                                    {{ 'Rp' . number_format($totalAbsent, 0, ',', '.')  }}
                                                </td>
                                               
                                                <td class="px-4 py-3 border-r">
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
                                                  
                                                    {{ 'Rp' . number_format($totalClean, 0, ',', '.') }}
                                                </td>
                                               
                                                <td class="px-4 py-3 border-r">
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
                                                     {{ 'Rp' . number_format($totalSLA, 0, ',', '.') }}                                          
                                                </td>
                                               
                                                <td class="px-4 py-3 border-r">
                                                    @php
                                                    $totalBBM = $employee->bbm->where('month_year',$selectedMonthYear . '-01')
                                                            ->where('vendor_id', $value->id)
                                                            ->sum('total');
                                                    @endphp
                                                    {{ 'Rp' . number_format($totalBBM, 0, ',', '.') }}
                                                </td>
                                              
                                                <td class="px-4 py-3 border-r">
                                                    @php
                                                    $totalRetri = $employee->retribution
                                                    ->where('vendor_id', $value->id)
                                                    ->sum('total');
                                                    @endphp
                                                    {{ 'Rp' . number_format($totalRetri, 0, ',', '.') }}
                                                </td>
                                              
                                                <td class="px-4 py-3 border-r">
                                                    @php
                                                    $totalInsentif = $employee->insentif->where('month_year',$selectedMonthYear . '-01')
                                                            ->where('vendor_id', $value->id)
                                                            ->sum('total');
                                                    @endphp
                                                    {{ 'Rp' . number_format($totalInsentif, 0, ',', '.') }}
                                                    {{-- {{ 'Rp' . number_format($employee->insentif->total, 0, ',', '.') }} --}}
                                                </td>
                                               
                                                <td class="px-4 py-3 border-r">
                                                    @php
                                                    $totalLainya = $employee->lainya->where('month_year',$selectedMonthYear . '-01')
                                                            ->where('vendor_id', $value->id)
                                                            ->sum('total');
                                                    @endphp
                                                    {{ 'Rp' . number_format($totalLainya, 0, ',', '.') }}
                                                    {{-- {{ 'Rp' . number_format($employee->lainya->total, 0, ',', '.') }} --}}
                                                </td>
                                               
                                                <td class="px-4 py-3 border-r">
                                                    @php
                                                    $totalPrev = $employee->previous->where('month_year',$selectedMonthYear . '-01')
                                                            ->where('vendor_id', $value->id)
                                                            ->sum('total');
                                                    @endphp
                                                    {{ 'Rp' . number_format($totalPrev, 0, ',', '.') }}
                                                    {{-- {{ 'Rp' . number_format($employee->previous->total, 0, ',', '.') }} --}}
                                                </td>
                                                
                                                <td class="px-4 py-3 border-r">
                                                    {{ 'Rp' . number_format($employee->bpjs->jht, 0, ',', '.') }}
                                                </td>
                                                <td class="px-4 py-3 border-r">
                                                    {{ 'Rp' . number_format($employee->bpjs->jkk, 0, ',', '.') }}
                                                </td>
                                                <td class="px-4 py-3 border-r">
                                                    {{ 'Rp' . number_format($employee->bpjs->jkm, 0, ',', '.') }}
                                                </td>
                                                <td class="px-4 py-3 border-r">
                                                    {{ 'Rp' . number_format($employee->bpjs->jp, 0, ',', '.') }}
                                                </td>
                                                <td class="px-4 py-3 border-r">
                                                    {{ 'Rp' . number_format($employee->bpjs->kes, 0, ',', '.') }}
                                                </td>
                                                <td class="px-4 py-3 border-r">
                                                    {{ 'Rp' . number_format($employee->bpjs->total_bpjs, 0, ',', '.') }}
                                                </td>
                                                <td class="px-4 py-3 border-r">
                                                  0
                                                </td>
                                                <td class="px-4 py-3 border-r">
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

<div class="py-12">
    <div class="sm:px-6 lg:px-8">
        <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
            <div class="w-full">
                <div class="flex justify-between items-center space-x-4 mb-4">
                    <div>
                        {{-- <button wire:click="$dispatch('open-modal', { name: 'create-employee-modal' })" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">Create employee</button> --}}
                        {{-- <button wire:click="$dispatch('open-modal', { name: 'import-bpjs-modal' })" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">Import</button> --}}
                        @php
                        // Get the URL
                        $url = request()->fullUrl();
                        
                        // Parse the URL to get the 'selectedMonthYear' parameter
                        parse_str(parse_url($url, PHP_URL_QUERY), $params);
                        $selectedMonthYear = $params['selectedMonthYear'] ?? '';  // Fallback in case the parameter is not set
                        
                        // Ensure that the selectedMonthYear is treated as a string and not a date object
                        $url = (string) $selectedMonthYear;
                        @endphp
                        <button wire:click="export('{{ $url }}')" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">Export</button>
                    </div>
                    <div class="flex-1 flex flex-col sm:flex-row justify-end items-end space-x-0 sm:space-x-2 space-y-2 sm:space-y-0">
                        <div class="relative w-full max-w-480">
                            <div class="flex items-center space-x-2">
                                <input disabled type="month" id="filterDate" wire:model.live.debounce="selectedMonthYear" class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                                {{-- <button wire:click="applyFilter" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">
                                    Terapkan Filter
                                </button> --}}
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
                            @if (count($summary) > 0)
                                @foreach ($summary as $key => $value)
                                    <tr class="bg-white border-b">
                                        <td class="px-4 py-3 border-r">{{ $value->area }}</td>
                                        <td class="px-4 py-3 border-r">
                                            {{ 'Rp' . number_format($value->total_salary, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3 border-r">
                                            {{ 'Rp' . number_format($value->total_lembur, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3 border-r">
                                            {{ 'Rp' . number_format($value->total_stand, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($value->total_makan, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($value->total_mel, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($value->total_unit, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($value->total_loading, 0, ',', '.') }}</td>

                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($value->total_bonus_kehadiran, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($value->total_kebersihan, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($value->total_sla, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($value->total_bbm, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($value->total_retribusi, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($value->total_insentif, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($value->total_lainnya, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($value->total_previous, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($value->total_bpjs, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">
                                            @php
                                                $totalGaji = $value->total_salary + $value->total_lembur + $value->total_stand + $value->total_makan + $value->total_bonus_kehadiran + $value->total_kebersihan + $value->total_sla + $value->total_bbm + $value->total_retribusi + $value->total_insentif + $value->total_lainnya + $value->total_previous + $value->total_bpjs;
                                            @endphp
                                            {{ 'Rp' . number_format($totalGaji, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3 border-r">
                                            @php
                                                $mgFee = $totalGaji * 0.05;
                                            @endphp
                                            {{ 'Rp' . number_format($mgFee, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3 border-r">
                                            @php
                                                $ppn = $mgFee * 0.11;
                                            @endphp
                                            {{ 'Rp' . number_format($ppn, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3 border-r">
                                            @php
                                                $pph = $totalGaji * 0.2;
                                            @endphp
                                            {{ 'Rp' . number_format($pph, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3 border-r">
                                            @php
                                                $totalInvoice = $totalGaji + $mgFee + $ppn + $pph;
                                            @endphp
                                            {{ 'Rp' . number_format($totalInvoice, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                                 {{-- Row Total Akumulasi --}}
                                    <tr class="bg-gray-200 font-semibold">
                                        <td class="px-4 py-3 border-r text-center">Total</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($summary->sum('total_salary'), 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($summary->sum('total_lembur'), 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($summary->sum('total_stand'), 0, ',', '.') }}</td>
                                        
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($summary->sum('total_makan'), 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($summary->sum('total_mel'), 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($summary->sum('total_unit'), 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($summary->sum('total_loading'), 0, ',', '.') }}</td>

                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($summary->sum('total_bonus_kehadiran'), 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($summary->sum('total_kebersihan'), 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($summary->sum('total_sla'), 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($summary->sum('total_bbm'), 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($summary->sum('total_retribusi'), 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($summary->sum('total_insentif'), 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($summary->sum('total_lainnya'), 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($summary->sum('total_previous'), 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">{{ 'Rp' . number_format($summary->sum('total_bpjs'), 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 border-r">
                                            @php
                                                $totalGaji = $summary->sum('total_salary') + $summary->sum('total_lembur') + $summary->sum('total_stand') + $summary->sum('total_makan')
                                                + $summary->sum('total_mel') + $summary->sum('total_unit') + $summary->sum('total_loading')
                                                 + $summary->sum('total_bonus_kehadiran') + $summary->sum('total_kebersihan') + $summary->sum('total_sla') + $summary->sum('total_bbm') + $summary->sum('total_retribusi') + $summary->sum('total_insentif') + $summary->sum('total_lainnya') + $summary->sum('total_previous') + $summary->sum('total_bpjs');
                                            @endphp
                                            {{ 'Rp' . number_format($totalGaji, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3 border-r">
                                            @php
                                                $mgFee = $totalGaji * 0.05;
                                            @endphp
                                            {{ 'Rp' . number_format($mgFee, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3 border-r">
                                            @php
                                                $ppn = $mgFee * 0.11;
                                            @endphp
                                            {{ 'Rp' . number_format($ppn, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3 border-r">
                                            @php
                                                $pph = $totalGaji * 0.2;
                                            @endphp
                                            {{ 'Rp' . number_format($pph, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3 border-r">
                                            @php
                                                $totalInvoice = $totalGaji + $mgFee + $ppn + $pph;
                                            @endphp
                                            {{ 'Rp' . number_format($totalInvoice, 0, ',', '.') }}
                                        </td>
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

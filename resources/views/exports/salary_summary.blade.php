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
            @foreach ($employees as $key => $value)
                <tr class="bg-white border-b">
                    <td class="px-4 py-3 border-r">{{ $value->area }}</td>
                    <td class="px-4 py-3 border-r">
                        {{ $value->total_salary }}
                    </td>
                    <td class="px-4 py-3 border-r">
                        {{ $value->total_lembur }}
                    </td>
                    <td class="px-4 py-3 border-r">
                        {{ $value->total_stand }}
                    </td>
                    <td class="px-4 py-3 border-r">{{ $value->total_makan }}</td>
                    <td class="px-4 py-3 border-r">{{ $value->total_bonus_kehadiran }}</td>
                    <td class="px-4 py-3 border-r">{{ $value->total_kebersihan }}</td>
                    <td class="px-4 py-3 border-r">{{ $value->total_sla }}</td>
                    <td class="px-4 py-3 border-r">{{ $value->total_bbm }}</td>
                    <td class="px-4 py-3 border-r">{{ $value->total_retribusi }}</td>
                    <td class="px-4 py-3 border-r">{{ $value->total_insentif }}</td>
                    <td class="px-4 py-3 border-r">{{ $value->total_lainnya }}</td>
                    <td class="px-4 py-3 border-r">{{ $value->total_previous }}</td>
                    <td class="px-4 py-3 border-r">{{ $value->total_bpjs }}</td>
                    <td class="px-4 py-3 border-r">
                        @php
                            $totalGaji = $value->total_salary + $value->total_lembur + $value->total_stand + $value->total_makan + $value->total_bonus_kehadiran + $value->total_kebersihan + $value->total_sla + $value->total_bbm + $value->total_retribusi + $value->total_insentif + $value->total_lainnya + $value->total_previous + $value->total_bpjs;
                        @endphp
                        {{ $totalGaji }}
                    </td>
                    <td class="px-4 py-3 border-r">
                        @php
                            $mgFee = $totalGaji * 0.05;
                        @endphp
                        {{ $mgFee }}
                    </td>
                    <td class="px-4 py-3 border-r">
                        @php
                            $ppn = $mgFee * 0.11;
                        @endphp
                        {{ $ppn }}
                    </td>
                    <td class="px-4 py-3 border-r">
                        @php
                            $pph = $totalGaji * 0.2;
                        @endphp
                        {{ $pph }}
                    </td>
                    <td class="px-4 py-3 border-r">
                        @php
                            $totalInvoice = $totalGaji + $mgFee + $ppn + $pph;
                        @endphp
                        {{ $totalInvoice }}
                    </td>
                </tr>
            @endforeach
                {{-- Row Total Akumulasi --}}
            <tr class="bg-gray-200 font-semibold">
                <td class="px-4 py-3 border-r text-center">Total</td>
                <td class="px-4 py-3 border-r">{{ $employees->sum('total_salary') }}</td>
                <td class="px-4 py-3 border-r">{{ $employees->sum('total_lembur') }}</td>
                <td class="px-4 py-3 border-r">{{ $employees->sum('total_stand') }}</td>
                <td class="px-4 py-3 border-r">{{ $employees->sum('total_makan') }}</td>
                <td class="px-4 py-3 border-r">{{ $employees->sum('total_bonus_kehadiran') }}</td>
                <td class="px-4 py-3 border-r">{{ $employees->sum('total_kebersihan') }}</td>
                <td class="px-4 py-3 border-r">{{ $employees->sum('total_sla') }}</td>
                <td class="px-4 py-3 border-r">{{ $employees->sum('total_bbm') }}</td>
                <td class="px-4 py-3 border-r">{{ $employees->sum('total_retribusi') }}</td>
                <td class="px-4 py-3 border-r">{{ $employees->sum('total_insentif') }}</td>
                <td class="px-4 py-3 border-r">{{ $employees->sum('total_lainnya') }}</td>
                <td class="px-4 py-3 border-r">{{ $employees->sum('total_previous') }}</td>
                <td class="px-4 py-3 border-r">{{ $employees->sum('total_bpjs') }}</td>
                <td class="px-4 py-3 border-r">
                    @php
                        $totalGaji = $employees->sum('total_salary') + $employees->sum('total_lembur') + $employees->sum('total_stand') + $employees->sum('total_makan') + $employees->sum('total_bonus_kehadiran') + $employees->sum('total_kebersihan') + $employees->sum('total_sla') + $employees->sum('total_bbm') + $employees->sum('total_retribusi') + $employees->sum('total_insentif') + $employees->sum('total_lainnya') + $employees->sum('total_previous') + $employees->sum('total_bpjs');
                    @endphp
                    {{ $totalGaji }}
                </td>
                <td class="px-4 py-3 border-r">
                    @php
                        $mgFee = $totalGaji * 0.05;
                    @endphp
                    {{ $mgFee }}
                </td>
                <td class="px-4 py-3 border-r">
                    @php
                        $ppn = $mgFee * 0.11;
                    @endphp
                    {{ $ppn }}
                </td>
                <td class="px-4 py-3 border-r">
                    @php
                        $pph = $totalGaji * 0.2;
                    @endphp
                    {{ $pph }}
                </td>
                <td class="px-4 py-3 border-r">
                    @php
                        $totalInvoice = $totalGaji + $mgFee + $ppn + $pph;
                    @endphp
                    {{ $totalInvoice }}
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>

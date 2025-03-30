<?php

namespace App\Exports;

use App\Models\EmployeeMaster;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeeExport implements FromCollection, WithHeadings, WithMapping
{
    public $search;
    public $client;
    public $status;
    public $selectedVendor;

    public function __construct($search, $client, $status, $selectedVendor)
    {
        $this->search = $search;
        $this->client = $client;
        $this->status = $status;
        $this->selectedVendor = $selectedVendor;
    }

    public function collection()
    {
        return EmployeeMaster::with(['area', 'vendors'])
            ->when($this->search !== '', fn($query) => $query->where('name', 'like', '%'.$this->search.'%'))
            ->when($this->client !== '', fn($query) => $query->where('client', $this->client))
            ->when($this->status !== '', fn($query) => $query->where('status', $this->status))
            ->when($this->selectedVendor !== '', fn($query) => $query->whereHas('vendors', fn($q) => $q->where('vendor_id', $this->selectedVendor)))
            ->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'NIK',
            'Client',
            'Status',
            'Area',
            'Vendors',
            'Join Date',
            'Resign Date',
        ];
    }

    public function map($employee): array
    {
        return [
            $employee->name,
            $employee->nik,
            $employee->client,
            $employee->status,
            $employee->area->area ?? 'N/A',
            $employee->vendors->pluck('name')->implode(', '),
            $employee->join_date,
            $employee->resign_date,
        ];
    }
}

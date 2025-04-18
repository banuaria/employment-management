<?php

namespace App\Livewire\Dashboard\Bpjs;

use App\Models\EmployBpjs;
use App\Models\EmployeeMaster;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class BpjsImport extends Component
{
    use WithFileUploads;

    public $employees = [];
    public $selectedMonthYear;
    public $employeeImport;
    public $errors = [];
    public $stat = 0;

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function mount()
    {
        // $this->areas = AreaPayroll::pluck('area', 'id');
    }

    public function render()
    {
        return view('livewire.dashboard.bpjs.bpjs-import');
    }

    public function checkData()
    {
        $this->validate([
            'employeeImport' => ['required', 'file', 'mimes:xlsx,csv'],
        ]);

        $data = Excel::toArray([], $this->employeeImport);

        if (empty($data) || empty($data[11]) || empty($data[12])) {
            $this->dispatch('alert-failure', title: 'Sheet 11 atau 12 kosong atau tidak ditemukan.');
            return;
        }

        $rowsSheet11 = $data[11];
        $rowsSheet12 = $data[12];

        $headers11 = array_map('strtolower', array_map('trim', $rowsSheet11[0]));
        $headers12 = array_map('strtolower', array_map('trim', $rowsSheet12[0]));

        $this->errors = [];
        $formattedData = [];

        // Buat mapping nik => kes dari sheet 12
        $kesMapping = [];
        for ($j = 1; $j < count($rowsSheet12); $j++) {
            $row = array_combine($headers12, $rowsSheet12[$j]);
            $nik = trim($row['nik'] ?? '');
            $kes = $row['kes'] ?? 0;

            if (!empty($nik)) {
                $kesMapping[$nik] = $kes;
            }
        }

        for ($i = 1; $i < count($rowsSheet11); $i++) {
            $rowData = array_combine($headers11, $rowsSheet11[$i]);

            $vendorName = trim($rowData['vendor'] ?? '');
            $nik = trim($rowData['nik'] ?? '');
            $statusText = strtoupper(trim($rowData['status'] ?? ''));

            // Konversi status
            $status = match ($statusText) {
                'REGULER' => 1,
                'LOADING' => 2,
                'HARIAN' => 3,
                default => null,
            };

            if (is_null($status)) {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": Status tidak valid.";
                continue;
            }

            if (empty($nik)) {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": NIK tidak boleh kosong.";
                continue;
            }

            $employee = EmployeeMaster::where('nik', $nik)->first();
            if (!$employee) {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": Employee dengan NIK $nik tidak ditemukan di database.";
                continue;
            }

            $vendor = Vendor::where('name', $vendorName)->first();
            if (!$vendor) {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": Vendor '$vendorName' tidak ditemukan di database.";
                continue;
            }

            $existsInPivot = DB::table('employee_masters')
                ->where('nik', $nik)
                ->where('vendor_id', $vendor->id)
                ->where('status', $employee->status)
                ->exists();

            if (!$existsInPivot) {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": Employee dengan NIK $nik, status $statusText dan vendor $vendorName tidak terdaftar di Employee Master.";
                continue;
            }

            $formatComponent = function ($value) {
                $formatted = str_replace(',', '.', $value);
                $decimalPart = explode('.', $formatted)[1] ?? '';
            
                if (
                    strlen($decimalPart) === 2 ||
                    ((int) ($decimalPart[2] ?? 0) > 0) ||
                    ((int) ($decimalPart[3] ?? 0) > 0)
                ) {
                    return ceil((float) $formatted);
                } else {
                    return floor((float) $formatted);
                }
            };

            $formattedData[] = [
                'vendor'    => $vendorName,
                'nik'       => $nik,
                'status'    => $status,
                'jht'       => $formatComponent($rowData['jht'] ?? 0),
                'jkk'       => $formatComponent($rowData['jkk'] ?? 0),
                'jp'        => $formatComponent($rowData['jp'] ?? 0),
                'jkm'       => $formatComponent($rowData['jkm'] ?? 0),
                'kes'       => $formatComponent($kesMapping[$nik] ?? 0),
            ];
        }

        $this->employees = $formattedData;
        $this->stat = empty($this->errors) ? 1 : 0;
    }

    

    private function convertExcelDate($value)
    {
        if (is_numeric($value)) {
            return Date::excelToDateTimeObject($value)->format('Y-m-d');
        }
        return $value; 
    }
    
    public function store()
    {

        if (empty($this->employees)) {
            $this->dispatch('alert-failure', title: 'No data to store, please check the uploaded file.');
            return;
        }
    
        $hasSuccess = false;
        $hasError = false;
    
        foreach ($this->employees as $employeeData) {
            $vendorName = $employeeData['vendor'];
            $status = $employeeData['status'];
            $vendor = Vendor::where('name', $vendorName)->first();
            $vendorId = $vendor ? $vendor->id : null;
            $nik = $employeeData['nik'];
            $jht = $employeeData['jht'] ?? 0;
            $jkk = $employeeData['jkk'] ?? 0;
            $jp  = $employeeData['jp'] ?? 0;
            $jkm = $employeeData['jkm'] ?? 0;
            $kes = $employeeData['kes'] ?? 0;
    
            $employee = EmployeeMaster::where('nik', $nik)->where('vendor_id', $vendorId)->where('status', $status)->first();
            if (!$employee) {
                $this->errors[] = "NIK $nik, status $status, vendor $vendorName tidak ditemukan di tabel master yang sama.";
                $hasError = true;
                continue;
            }
    
            $employeeId = $employee->id;
            $bpjs = EmployBpjs::where('employee_id', $employeeId)->where('vendor_id', $vendorName)->where('status', $status)->first();
    
            $data = $bpjs
                ? $bpjs->update([
                    'jht' => $jht,
                    'jkk' => $jkk,
                    'jp'  => $jp,
                    'jkm' => $jkm,
                    'kes' => $kes,
                    'status' => $status,
                    'vendor_id' => $vendorId,
                ])
                : EmployBpjs::create([
                    'employee_id' => $employeeId,
                    'jht' => $jht,
                    'jkk' => $jkk,
                    'jp'  => $jp,
                    'jkm' => $jkm,
                    'kes' => $kes,
                    'status' => $status,
                    'vendor_id' => $vendorId,
                ]);
    
            $data ? $hasSuccess = true : $hasError = true;
        }
    
        // Dispatch alert sekali di akhir proses
        if ($hasSuccess && !$hasError) {
            $this->dispatch('alert-success', title: 'BPJS Successfully Imported!');
        } elseif ($hasSuccess && $hasError) {
            $this->dispatch('alert-warning', title: 'Sebagian data berhasil diimpor, namun ada yang gagal. Cek kembali.');
        } else {
            $this->dispatch('alert-failure', title: 'Semua data gagal diimpor.');
        }
    
        // Reset jika ada data sukses
        if ($hasSuccess) {
            $this->dispatch('bpjs-imported');
            $this->dispatch('close-modal', name: 'import-bpjs-modal');
            $this->reset();
            $this->resetValidation();
        }
    }
    
}

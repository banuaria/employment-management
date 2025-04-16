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
    
        // Normalisasi headers dari kedua sheet
        $headersSheet11 = array_map('strtolower', array_map('trim', $data[11][0]));
        $headersSheet12 = array_map('strtolower', array_map('trim', $data[12][0]));
    
        $rowsSheet11 = array_slice($data[11], 1);
        $rowsSheet12 = array_slice($data[12], 1);
    
        $sheet11Data = [];
        $sheet12Data = [];
    
        // Parsing data dari sheet 11
        foreach ($rowsSheet11 as $row) {
            $rowData = array_combine($headersSheet11, $row);
            $nik = trim($rowData['nik'] ?? '');
            if ($nik !== '') {
                $sheet11Data[$nik] = [
                    'jht' => $rowData['jht'] ?? 0,
                    'jkk' => $rowData['jkk'] ?? 0,
                    'jp'  => $rowData['jp'] ?? 0,
                    'jkm' => $rowData['jkm'] ?? 0,
                ];
            }
        }
    
        // Parsing data dari sheet 12
        foreach ($rowsSheet12 as $row) {
            $rowData = array_combine($headersSheet12, $row);
            $nik = trim($rowData['nik'] ?? '');
            if ($nik !== '') {
                $sheet12Data[$nik] = [
                    'kes' => $rowData['kes'] ?? 0,
                ];
            }
        }
    
        // Gabungkan berdasarkan nik
        $allNik = array_unique(array_merge(array_keys($sheet11Data), array_keys($sheet12Data)));
    
        $this->errors = [];
        $this->employees = [];
    
        foreach ($allNik as $nik) {
            $jht = $sheet11Data[$nik]['jht'] ?? 0;
            $jkk = $sheet11Data[$nik]['jkk'] ?? 0;
            $jp  = $sheet11Data[$nik]['jp'] ?? 0;
            $jkm = $sheet11Data[$nik]['jkm'] ?? 0;
            $kes = $sheet12Data[$nik]['kes'] ?? 0;
    
            // Cek apakah NIK ada di DB
            $employee = EmployeeMaster::where('nik', $nik)->first();
            if (!$employee) {
                $this->errors[] = "NIK $nik tidak ditemukan di database.";
                continue;
            }
    
            $this->employees[] = [
                'nik' => $nik,
                'jht' => $jht ?? 0,
                'jkk' => $jkk ?? 0,
                'jp'  => $jp ?? 0,
                'jkm' => $jkm ?? 0,
                'kes' => $kes ?? 0,
            ];
        }
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
            $nik = $employeeData['nik'];
            $jht = $employeeData['jht'] ?? 0;
            $jkk = $employeeData['jkk'] ?? 0;
            $jp  = $employeeData['jp'] ?? 0;
            $jkm = $employeeData['jkm'] ?? 0;
            $kes = $employeeData['kes'] ?? 0;
    
            $employee = EmployeeMaster::where('nik', $nik)->first();
    
            if (!$employee) {
                $this->errors[] = "NIK $nik tidak ditemukan di tabel master.";
                $hasError = true;
                continue;
            }
    
            $employeeId = $employee->id;
            $bpjs = EmployBpjs::where('employee_id', $employeeId)->first();
    
            $data = $bpjs
                ? $bpjs->update([
                    'jht' => $jht,
                    'jkk' => $jkk,
                    'jp'  => $jp,
                    'jkm' => $jkm,
                    'kes' => $kes,
                ])
                : EmployBpjs::create([
                    'employee_id' => $employeeId,
                    'jht' => $jht,
                    'jkk' => $jkk,
                    'jp'  => $jp,
                    'jkm' => $jkm,
                    'kes' => $kes,
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

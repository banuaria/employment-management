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
      
    
        // Read the Excel file and convert it into an array
        $data = Excel::toArray([], $this->employeeImport);
    
        // Ensure the sheet contains data
        if (empty($data) || empty($data[0])) {
            $this->dispatch('alert-failure', title: 'Excel file is empty or improperly formatted.');
            return;
        }
    
        // Get the first sheet data
        $rows = $data[0];
    
        // Extract headers from the first row
        $headers = array_map('strtolower', array_map('trim', $rows[0])); // Normalize headers
        // $filePairs = []; // Store (nik, vendor) pairs to check duplicates within the file
    
        $this->errors = [];
        $formattedData = [];

        for ($i = 1; $i < count($rows); $i++) {
            $row = array_combine($headers, $rows[$i]);

            // Standardize vendor & employee ID keys
            $vendorName = trim($row['vendor'] ?? '');
            $nik = trim($row['nik'] ?? '');

            // **1. Validasi jika NIK kosong**
            if (empty($nik)) {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": NIK tidak boleh kosong.";
                continue;
            }

            // **2. Validasi duplikat (NIK, Vendor) dalam file**
            $pairKey = $nik . '|' . $vendorName;
            if (isset($filePairs[$pairKey])) {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": Employee dengan NIK $nik sudah ada dua kali dalam file untuk vendor $vendorName.";
                continue;
            }
            $filePairs[$pairKey] = true;
            // // **3. Cek apakah employee (NIK) ada di database**
            $employee = EmployeeMaster::where('nik', $nik)->first();
            if (!$employee) {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": Employee dengan NIK $nik tidak ditemukan di database.";
                continue;
            }

            // **4. Validasi jika jht, jp, jkm, atau kes kosong**
            $mandatoryFields = ['jht','jkk', 'jp', 'jkm', 'kes'];
            foreach ($mandatoryFields as $field) {
            if (!isset($row[$field]) || trim($row[$field]) === '') {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": Kolom $field tidak boleh kosong.";
            }
        }

            $formattedData[] = [
                'nik'       => $nik,
                'jht'       => $row['jht'] ?? null,
                'jkk'       => $row['jkk'] ?? null,
                'jp'        => $row['jp'] ?? null,
                'jkm'       => $row['jkm'] ?? null,
                'kes'       => $row['kes'] ?? null,
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

        $nikMap = []; // Untuk memastikan hanya satu EmployeeMaster per NIK

        foreach ($this->employees as $employeeData) {
            $nik = $employeeData['nik'];
            $jht = $employeeData['jht'];
            $jkk = $employeeData['jkk'];
            $jp = $employeeData['jp'];
            $jkm = $employeeData['jkm'];
            $kes = $employeeData['kes'];

            $employeer = EmployeeMaster::where('nik', $nik)->first();
            $employeeId = $employeer ? $employeer->id : null;
            

            $existingAbsence = EmployBpjs::where([
                'employee_id' => $employeer->id,
            ])->exists();

            if ($existingAbsence) {
                $this->dispatch('alert-failure', title: "Absence data for NIK $nik and Vendor '$vendorName' in $monthYear already exists.");
                continue;
            }
            $data = EmployBpjs::create([
                'employee_id' => $employeeId,
                'jht'   => $jht,
                'jkk'   => $jkk,
                'jp'  => $jp,
                'jkm'  => $jkm,
                'kes'  => $kes,
            ]);

            if ($data) {
                $this->dispatch('bpjs-imported');
                $this->dispatch('close-modal', name: 'import-bpjs-modal');
                $this->reset();
                $this->resetValidation();
                $this->dispatch('alert-success', title: 'BPJS Successfully Imported!');
            } else {
                $this->dispatch('alert-failure', title: 'Failed to Import BPJS employ');
            }
    
        }
    }
}

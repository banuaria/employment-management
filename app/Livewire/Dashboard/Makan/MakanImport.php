<?php

namespace App\Livewire\Dashboard\Makan;

use App\Models\Makan;
use App\Models\EmployeeMaster;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class MakanImport extends Component
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
        return view('livewire.dashboard.makan.makan-import');
    }

    public function checkData()
    {
        $this->validate([
            'selectedMonthYear' => ['required', 'date_format:Y-m'],
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
        // batas
    
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
            // $pairKey = $nik . '|' . $vendorName;
            // if (isset($filePairs[$pairKey])) {
            //     $this->errors[] = "Error pada baris " . ($i + 1) . ": Employee dengan NIK $nik sudah ada dua kali dalam file untuk vendor $vendorName.";
            //     continue;
            // }
            // $filePairs[$pairKey] = true;
            // // **3. Cek apakah employee (NIK) ada di database**
            $employee = EmployeeMaster::where('nik', $nik)->first();
            if (!$employee) {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": Employee dengan NIK $nik tidak ditemukan di database.";
                continue;
            }

            // **4. Cek apakah vendor ada di database**
            $vendor = Vendor::where('name', $vendorName)->first();
            if (!$vendor) {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": Vendor '$vendorName' tidak ditemukan di database.";
                continue;
            }

            // **5. Cek apakah kombinasi NIK dan Vendor ada di tabel pivot**
            $existsInPivot = DB::table('employee_master_vendor')
                ->where('employee_master_id', $employee->id)
                ->where('vendor_id', $vendor->id)
                ->exists();

            if (!$existsInPivot) {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": Employee dengan NIK $nik tidak terdaftar pada vendor '$vendorName'.";
                continue;
            }

            // **6. Simpan data valid ke array**
            $formattedData[] = [
                'monthYear' => $this->selectedMonthYear,
                'vendor'    => $vendorName,
                'nik'       => $nik,
                'total'     => $row['total'] ?? null,
                'total_mel' => $row['total mel'] ?? null,
                'total_unit' => $row['total unit'] ?? null,
                'total_loading' => $row['total loading'] ?? null,
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
            $vendorName = $employeeData['vendor'];
            $monthYear = $employeeData['monthYear'];
            $monthYearFormat = Carbon::createFromFormat('Y-m', $monthYear)->format('Y-m-01');
            $total = $employeeData['total'] ?? 0;
            $totalMel = $employeeData['total_mel'] ?? 0;
            $totalUnit = $employeeData['total_unit'] ?? 0;
            $totalLoading = $employeeData['total_loading'] ?? 0;


            $vendor = Vendor::where('name', $vendorName)->first();
            $vendorId = $vendor ? $vendor->id : null;
            $employeer = EmployeeMaster::where('nik', $nik)->first();
            $employeeId = $employeer ? $employeer->id : null;

            $existingAbsence = Makan::where([
                'employee_id' => $employeer->id,
                'vendor_id' => $vendor->id,
                'month_year' => $monthYear,
            ])->exists();

            if ($existingAbsence) {
                $this->dispatch('alert-failure', title: "Absence data for NIK $nik and Vendor '$vendorName' in $monthYear already exists.");
                continue;
            }
            $data = Makan::create([
                'employee_id' => $employeeId,
                'vendor_id'   => $vendorId,
                'month_year'  => $monthYearFormat,
                'total'       => $total,
                'total_mel'   => $totalMel,
                'total_unit'  => $totalUnit,
                'total_loading' => $totalLoading,
            ]);

            if ($data) {
                $this->dispatch('makan-imported');
                $this->dispatch('close-modal', name: 'import-makan-modal');
                $this->reset();
                $this->resetValidation();
                $this->dispatch('alert-success', title: 'Total Amount Makan Successfully Imported!');
            } else {
                $this->dispatch('alert-failure', title: 'Failed to Import Makan');
            }
    
        }
    }
}

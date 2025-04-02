<?php

namespace App\Livewire\Dashboard\Employee;

use App\Models\AreaPayroll;
use App\Models\EmployeeMaster;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class EmployeeImport extends Component
{
    use WithFileUploads;

    public $employees = [];
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
        return view('livewire.dashboard.employee.employee-import');
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
    
        // Prepare the formatted data
        $formattedData = [];
        $this->errors = []; // Reset errors
        $filePairs = []; // Store (nik, vendor) pairs to check duplicates within the file
    
        for ($i = 1; $i < count($rows); $i++) {
            $row = array_combine($headers, $rows[$i]);
    
            // Standardize vendor & employee ID keys
            $vendorName = trim($row['vendorname'] ?? '');
            $nik = trim($row['nik'] ?? '');
    
            // Check for duplicate (nik, vendorname) pairs **inside the file itself**
            // **1. Validasi jika NIK kosong**
            if (empty($nik)) {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": NIK tidak boleh kosong.";
                continue;
            }

            // **2. Validasi panjang NIK (harus 16 digit angka)**
            if (!preg_match('/^\d{16}$/', $nik)) {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": NIK harus terdiri dari 16 digit angka.";
                continue;
            }

            // **3. Validasi duplikat (NIK, Vendor) dalam file**
            $pairKey = $nik . '|' . $vendorName;
            if (isset($filePairs[$pairKey])) {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": Employee dengan NIK $nik sudah ada dua kali dalam file untuk vendor $vendorName.";
                continue;
            }

           // **4. Validasi jika joindate kosong**
            if (empty($row['joindate'])) {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": Tanggal bergabung (joindate) tidak boleh kosong.";
                continue;
            }

            $filePairs[$pairKey] = true;
            // Check if employee exists in EmployeeMaster
            $employee = EmployeeMaster::where('nik', $nik)->first();
    
            // Jika employee belum ada di database, lanjutkan tanpa error
            if (!$employee) {
                $joinDate = isset($row['joindate']) ? $this->convertExcelDate($row['joindate']) : null;
                $formattedData[] = [
                    'vendor'     => $vendorName,
                    'client'     => $row['client'] ?? null,
                    'area_id'    => $row['area'] ?? null,
                    'status'     => $row['status'] ?? null,
                    'join_date'  => $joinDate ?? null,
                    'nik'        => $nik,
                    'name'       => $row['name'] ?? null,
                ];
                continue;
            }
    
            // Check if vendor exists
            $vendor = Vendor::where('name', $vendorName)->first();
            if (!$vendor) {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": Vendor '$vendorName' tidak ditemukan di database.";
                continue;
            }
    
            // Check if the employee/vendor pair already exists in the pivot table
            $existsInPivot = DB::table('employee_master_vendor')
                ->where('employee_master_id', $employee->id)
                ->where('vendor_id', $vendor->id)
                ->exists();
    
            if ($existsInPivot) {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": Employee dengan NIK $nik sudah terdaftar dengan vendor $vendorName di database.";
                continue;
            }
    
            // Convert date
            $joinDate = isset($row['joindate']) ? $this->convertExcelDate($row['joindate']) : null;
    
            // Store valid data
            $formattedData[] = [
                'vendor'     => $vendorName,
                'client'     => $row['client'] ?? null,
                'area_id'    => $row['area'] ?? null,
                'status'     => $row['status'] ?? null,
                'join_date'  => $joinDate,
                'nik'        => $nik,
                'name'       => $row['name'] ?? null,
            ];
        }
    
        $this->employees = $formattedData;
    
        // Set validation status
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
       // Check if there are any employee data to store
        if (empty($this->employees)) {
            $this->dispatch('alert-failure', title: 'No data to store, please check the uploaded file.');
            return;
        }

        $nikMap = []; // Untuk memastikan hanya satu EmployeeMaster per NIK

        foreach ($this->employees as $employeeData) {
            $nik = $employeeData['nik'];
            $vendorName = $employeeData['vendor'];

            $area = AreaPayroll::where('area', $employeeData['area_id'])->first();
            $areaId = $area ? $area->id : null; // Jika tidak ditemukan, set null

            // Cek apakah employee dengan NIK ini sudah ada di database
            $emp = EmployeeMaster::where('nik', $nik)->first();

            if (!$emp) {
                // Jika belum ada di database dan belum dibuat dalam iterasi ini, buat baru
                if (!isset($nikMap[$nik])) {
                    $emp = EmployeeMaster::create([
                        'client'     => $employeeData['client'],
                        'status'     => $employeeData['status'],
                        'join_date'  => $employeeData['join_date'],
                        'nik'        => $nik,
                        'area_id'    => $areaId,
                        'name'       => $employeeData['name'],
                    ]);

                    // Simpan reference agar tidak membuat duplikat
                    $nikMap[$nik] = $emp;
                }
            } else {
                // Jika sudah ada di database, gunakan yang sudah ada
                $nikMap[$nik] = $emp;
            }

            // Proses vendor (relasi di pivot table)
            if ($vendorName) {
                // Cek apakah vendor ada di database
                $vendor = Vendor::where('name', $vendorName)->first();

                if ($vendor) {
                    // Cek apakah pasangan (employee, vendor) sudah ada di pivot table
                    $existsInPivot = DB::table('employee_master_vendor')
                        ->where('employee_master_id', $emp->id)
                        ->where('vendor_id', $vendor->id)
                        ->exists();

                    if (!$existsInPivot) {
                        $emp->vendors()->attach($vendor->id);
                    }
                }
            }

            if ($emp && $vendor) {
                $this->dispatch('employee-imported');
                $this->dispatch('close-modal', name: 'import-employee-modal');
                $this->dispatch('alert-success', title: 'Employee Successfully Imported!');
            } else {
                $this->dispatch('alert-failure', title: 'Failed to Import Employee');
            }
        }
    }
}

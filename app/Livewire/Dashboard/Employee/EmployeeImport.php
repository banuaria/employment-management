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
        
        $rows = $data[0];
    
        // Extract headers from the first row
        $headers = array_map('strtolower', array_map('trim', $rows[0])); // Normalize headers
        // dd($headers);
    
        // Prepare the formatted data
        $formattedData = [];
        $this->errors = []; // Reset errors
        $filePairs = []; // Store (nik, vendor) pairs to check duplicates within the file
    
        for ($i = 1; $i < count($rows); $i++) {
            $row = array_combine($headers, $rows[$i]);
            // dd($row);
    
            // Standardize vendor & employee ID keys
            $vendorName = trim($row['vendorname'] ?? '');
            $nameEmp = trim($row['name'] ?? '');

            // dd($vendorName);
            $vendorId = Vendor::where('name', $vendorName)->first()->id ?? null;

            $nik = trim($row['nik'] ?? '');
            $status = trim($row['status'] ?? '');

          // 1: REGULER | 2: LOADING | 3: HARIAN
            if($status == 'REGULER') {
                $status = 1;
            } elseif($status == 'LOADING') {
                $status = 2;
            } elseif($status == 'HARIAN') {
                $status = 3;
            } else {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": Status tidak valid untuk karyawan '$nameEmp'.";
                continue;
            }

            // 1. Validasi jika NIK kosong
            if (empty($nik)) {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": NIK tidak boleh kosong untuk karyawan '$nameEmp'.";
                continue;
            }

            // 2. Validasi panjang NIK (harus 16 digit angka)
            if (!preg_match('/^\d{16}$/', $nik)) {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": NIK harus terdiri dari 16 digit angka untuk karyawan '$nameEmp'.";
                continue;
            }

            // 3. Validasi duplikat (NIK, Vendor, Status) dalam file
            $pairKey = $nik . '|' . $vendorName . '|' . $status;
            if (isset($filePairs[$pairKey])) {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": Kombinasi NIK $nik, vendor $vendorName, dan status $status sudah ada dalam file (karyawan '$nameEmp').";
                continue;
            }

            // 4. Validasi jika joindate kosong
            if (empty($row['joindate'])) {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": Tanggal bergabung (joindate) tidak boleh kosong untuk karyawan '$nameEmp'.";
                continue;
            }

            // Check if vendor exists
            $vendor = Vendor::where('name', $vendorName)->first();
            if (!$vendor) {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": Vendor '$vendorName' tidak ditemukan di database (karyawan '$nameEmp').";
                continue;
            }

            $filePairs[$pairKey] = true;
            // Check if employee exists in EmployeeMaster
            $employee = EmployeeMaster::where('nik', $nik)->first();
    
            // Jika employee belum ada di database, lanjutkan tanpa error
            if (!$employee) {
                $joinDate = isset($row['joindate']) ? $this->convertExcelDate($row['joindate']) : null;
                $formattedData[] = [
                    'vendor_id'   => $vendorId,
                    'client'     => $row['client'] ?? null,
                    'area_id'    => $row['area'] ?? null,
                    'status'     => $status,
                    'join_date'  => $joinDate ?? null,
                    'nik'        => $nik,
                    'name'       => $row['name'] ?? null,
                ];
                continue;
            }

            // dd($formattedData);
    
    
            // Check if the employee/vendor pair already exists in the pivot table
            $existsInPivot = DB::table('employee_masters')
                ->where('nik', $nik)
                ->where('vendor_id', $vendorId)
                ->where('status', $status)
                ->exists();
    
            if ($existsInPivot) {
                $this->errors[] = "Error pada baris " . ($i + 1) . ": Employee dengan NIK $nik dengan role $status sudah terdaftar dengan vendor $vendorName di database.";
                continue;
            }
    
            // Convert date
            $joinDate = isset($row['joindate']) ? $this->convertExcelDate($row['joindate']) : null;


    
            // Store valid data
            $formattedData[] = [
                'vendor_id'  => $vendorId,
                'client'     => $row['client'] ?? null,
                'area_id'    => $row['area'] ?? null,
                'status'     => $status,
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
        // If it's a numeric Excel date
        if (is_numeric($value)) {
            return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)->format('Y-m-d');
        }

        // Handle custom string format like '20/03.2025'
        if (preg_match('/^\d{2}\/\d{2}\.\d{4}$/', $value)) {
            // Convert 20/03.2025 to 20-03-2025 for parsing
            $value = str_replace('/', '-', str_replace('.', '-', $value));
            $date = \DateTime::createFromFormat('d-m-Y', $value);
            if ($date) {
                return $date->format('Y-m-d');
            }
        }

        // Return original if it can't be parsed
        return $value;
    }

    
    public function store()
    {
        if (empty($this->employees)) {
            $this->dispatch('alert-failure', title: 'No data to store, please check the uploaded file.');
            return;
        }

        $nikMap = [];
        $batchData = [];

        foreach ($this->employees as $employeeData) {
            $nik = $employeeData['nik'];
            $vendorId = $employeeData['vendor_id'];
            $area = AreaPayroll::where('area', $employeeData['area_id'])->first();
            $areaId = $area ? $area->id : null;

            $emp = EmployeeMaster::where('nik', $nik)->first();

            // Add the employee to the batch if it doesn't exist
            if (!$emp) {
                $batchData[] = [
                    'client'     => $employeeData['client'],
                    'status'     => $employeeData['status'],
                    'join_date'  => $employeeData['join_date'],
                    'vendor_id'  => $vendorId,
                    'nik'        => $nik,
                    'area_id'    => $areaId,
                    'name'       => $employeeData['name'],
                ];

                // Mark the NIK as processed
                $nikMap[$nik] = true;
            } else {
                $nikMap[$nik] = $emp ?? null;
            }
        }

        // Perform batch insert if there is new employee data to insert
        if (!empty($batchData)) {
            $insertedEmployees = EmployeeMaster::insert($batchData);
        }

        // Now process the vendor associations for both new and existing employees
        // foreach ($this->employees as $employeeData) {
        //     $nik = $employeeData['nik'];
        //     $area = AreaPayroll::where('area', $employeeData['area_id'])->first();
        //     $employeAreaId = $area ? $area->id : null;

        //     $status = $employeeData['status'];
        //     $vendorName = $employeeData['vendor'];
        //     $emp = EmployeeMaster::where('nik', $nik)->first();

        //     // Process vendor in batch if employee exists
        //     if ($vendorName && $emp) {
        //         $vendor = Vendor::where('name', $vendorName)->first();
        //         if ($vendor) {
        //             $existsInPivot = DB::table('employee_master_vendor')
        //                 ->where('employee_master_id', $emp->id)
        //                 ->where('vendor_id', $vendor->id)
        //                 ->where('status', $status)
        //                 ->exists();

        //                 if (!$existsInPivot) {
        //                     $emp->vendors()->attach($vendor->id, [
        //                         'status'    => $status,
        //                         'area_id'   => $employeAreaId,
        //                     ]);
        //                 }
        //         }
        //     }
        // }
        $this->dispatch('employee-imported');
        $this->dispatch('close-modal', name: 'import-employee-modal');
        $this->dispatch('alert-success', title: 'Employee Successfully Imported!');
    }

}

<?php

namespace App\Imports;

use App\Models\EmployeeMaster;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportEmployeeMaster implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new EmployeeMaster([
            
           
            'client'    => $row['client'],
            'status'    => $row['status'],
            'join_date' => $row['join_date'],
            'resign_date'=> $row['resign_date'],
            'area_id'   => $row['area_id'],
            'nik'       => $row['nik'],
            'name'      => $row['Driver Name'],
        ]);
    }
}

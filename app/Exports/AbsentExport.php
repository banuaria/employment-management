<?php

namespace App\Exports;

use App\Models\AbsentMontly;
use Maatwebsite\Excel\Concerns\FromCollection;

class AbsentExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AbsentMontly::all();
    }
}

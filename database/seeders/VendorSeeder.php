<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'GSI'],
            ['name' => 'EGS'],
            ['name' => 'GSS'],
           
        ];
        DB::table('vendors')->insert($data);
    }
}

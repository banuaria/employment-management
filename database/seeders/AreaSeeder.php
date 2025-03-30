<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['area' => 'BTJ', 'name' => 'BANDA ACEH', 'umk' => 3685616, 'total_harian' => null],
            ['area' => 'MES', 'name' => 'MEDAN', 'umk' => 3732906, 'total_harian' => null],
            ['area' => 'RPT', 'name' => 'RANTAU PRAPAT', 'umk' => 3438181, 'total_harian' => null],
            ['area' => 'PKU', 'name' => 'PEKANBARU', 'umk' => 3675937, 'total_harian' => null],
            ['area' => 'BTH', 'name' => 'BATAM', 'umk' => 4989600, 'total_harian' => null],
            ['area' => 'TNJ', 'name' => 'BATAM', 'umk' => 3623654, 'total_harian' => null],
            ['area' => 'PDG', 'name' => 'PADANG', 'umk' => 2994193, 'total_harian' => null],
            ['area' => 'DJB', 'name' => 'JAMBI', 'umk' => 3607223, 'total_harian' => null],
            ['area' => 'PGK', 'name' => 'PALEMBANG', 'umk' => null, 'total_harian' => null],
            ['area' => 'PLM', 'name' => 'PALEMBANG', 'umk' => 3715028, 'total_harian' => 120000],
            ['area' => 'TJQ', 'name' => 'PALEMBANG', 'umk' => null, 'total_harian' => null],
            ['area' => 'BKS', 'name' => 'BENGKULU', 'umk' => null, 'total_harian' => null],
            ['area' => 'LLG', 'name' => 'BENGKULU', 'umk' => null, 'total_harian' => null],
            ['area' => 'TKG', 'name' => 'LAMPUNG', 'umk' => 3305367, 'total_harian' => 120000],
            ['area' => 'JAT', 'name' => 'JAKARTA', 'umk' => 5396761, 'total_harian' => 150000],
            ['area' => 'SEG', 'name' => 'TANGERANG', 'umk' => 5069708, 'total_harian' => 150000],
            ['area' => 'TGR', 'name' => 'TANGERANG', 'umk' => 5069708, 'total_harian' => 150000],
            ['area' => 'BKI', 'name' => 'BEKASI', 'umk' => 5690753, 'total_harian' => null],
            ['area' => 'CKR', 'name' => 'BEKASI', 'umk' => 5558515, 'total_harian' => null],
            ['area' => 'BGR', 'name' => 'BOGOR', 'umk' => 5126897, 'total_harian' => 150000],
            ['area' => 'DPK', 'name' => 'DEPOK', 'umk' => 5195721, 'total_harian' => null],
            ['area' => 'BDO', 'name' => 'BANDUNG', 'umk' => 4482915, 'total_harian' => 150000],
            ['area' => 'CKP', 'name' => 'BANDUNG', 'umk' => 5599593, 'total_harian' => null],
            ['area' => 'CRN', 'name' => 'BANDUNG', 'umk' => 2697685, 'total_harian' => null],
            ['area' => 'SMI', 'name' => 'BANDUNG', 'umk' => 3604482, 'total_harian' => null],
            ['area' => 'TSK', 'name' => 'BANDUNG', 'umk' => 2699992, 'total_harian' => 120000],
            ['area' => 'SRG', 'name' => 'SEMARANG', 'umk' => 3454827, 'total_harian' => 120000],
            ['area' => 'TGL', 'name' => 'SEMARANG', 'umk' => 2333586, 'total_harian' => null],
            ['area' => 'PWO', 'name' => 'SEMARANG', 'umk' => 2338410, 'total_harian' => null],
            ['area' => 'PTI', 'name' => 'SEMARANG', 'umk' => 2680856, 'total_harian' => null],
            ['area' => 'CLP', 'name' => 'JOGJAKARTA', 'umk' => 2259874, 'total_harian' => null],
            ['area' => 'JOG', 'name' => 'JOGJAKARTA', 'umk' => 2360533, 'total_harian' => null],
            ['area' => 'SOC', 'name' => 'JOGJAKARTA', 'umk' => 2437110, 'total_harian' => 120000],
            ['area' => 'DLG', 'name' => 'JOGJAKARTA', 'umk' => 2389873, 'total_harian' => 150000],
            ['area' => 'BWI', 'name' => 'SURABAYA', 'umk' => 2810139, 'total_harian' => null],
            ['area' => 'JBR', 'name' => 'SURABAYA', 'umk' => 2838642, 'total_harian' => null],
            ['area' => 'KDR', 'name' => 'SURABAYA', 'umk' => 2492811, 'total_harian' => null],
            ['area' => 'MDN', 'name' => 'SURABAYA', 'umk' => 2422105, 'total_harian' => 120000],
            ['area' => 'MLG', 'name' => 'SURABAYA', 'umk' => 3553530, 'total_harian' => null],
            ['area' => 'SUB', 'name' => 'SURABAYA', 'umk' => 4870511, 'total_harian' => 150000],
            ['area' => 'GSK', 'name' => 'SURABAYA', 'umk' => 4874133, 'total_harian' => 150000],
            ['area' => 'LMG', 'name' => 'SURABAYA', 'umk' => 2525132, 'total_harian' => null],
            ['area' => 'PRO', 'name' => 'SURABAYA', 'umk' => 2876657, 'total_harian' => null],
            ['area' => 'AMI', 'name' => 'BALI', 'umk' => null, 'total_harian' => null],
            ['area' => 'BMU', 'name' => 'BALI', 'umk' => null, 'total_harian' => null],
            ['area' => 'DPS', 'name' => 'BALI', 'umk' => 3298116, 'total_harian' => null],
            ['area' => 'KOE', 'name' => 'BALI', 'umk' => 3569682, 'total_harian' => null],
            ['area' => 'LAB', 'name' => 'BALI', 'umk' => null, 'total_harian' => null],

            ['area' => 'MOF', 'name' => 'BALI', 'umk' => null, 'total_harian' => null],
            ['area' => 'TAM', 'name' => 'BALI', 'umk' => null, 'total_harian' => null],
            ['area' => 'KDI', 'name' => 'MAKASAR', 'umk' => null, 'total_harian' => null],
            ['area' => 'PWX', 'name' => 'MAKASAR', 'umk' => null, 'total_harian' => null],
            ['area' => 'UPG', 'name' => 'MAKASAR', 'umk' => null, 'total_harian' => null],
            ['area' => 'AMQ', 'name' => 'MANADO JAMES', 'umk' => null, 'total_harian' => null],
            ['area' => 'GTO', 'name' => 'MANADO JOHAN', 'umk' => null, 'total_harian' => null],
            ['area' => 'MDC', 'name' => 'MANADO JAMES', 'umk' => null, 'total_harian' => null],
            ['area' => 'PLW', 'name' => 'MANADO JOHAN', 'umk' => null, 'total_harian' => null],
            ['area' => 'TTE', 'name' => 'MANADO JAMES', 'umk' => null, 'total_harian' => null],
            ['area' => 'PKY', 'name' => 'SAMPIT', 'umk' => null, 'total_harian' => null],
            ['area' => 'SMQ', 'name' => 'SAMPIT', 'umk' => null, 'total_harian' => null],
            ['area' => 'PNK', 'name' => 'PONTIANAK', 'umk' => 3024820, 'total_harian' => 120000],
            ['area' => 'BDJ', 'name' => 'BALIKPAPAN', 'umk' => null, 'total_harian' => null],
            ['area' => 'BEU', 'name' => 'BALIKPAPAN', 'umk' => null, 'total_harian' => null],
            ['area' => 'BPN', 'name' => 'BALIKPAPAN', 'umk' => null, 'total_harian' => null],
            ['area' => 'TRK', 'name' => 'BALIKPAPAN', 'umk' => null, 'total_harian' => null],
            ['area' => 'BIK', 'name' => 'PAPUA', 'umk' => null, 'total_harian' => null],
            ['area' => 'DJJ', 'name' => 'PAPUA', 'umk' => null, 'total_harian' => null],
            ['area' => 'MKQ', 'name' => 'PAPUA', 'umk' => null, 'total_harian' => null],
            ['area' => 'MKW', 'name' => 'PAPUA', 'umk' => null, 'total_harian' => null],
            ['area' => 'NBX', 'name' => 'PAPUA', 'umk' => null, 'total_harian' => null],
            ['area' => 'SOQ', 'name' => 'PAPUA', 'umk' => null, 'total_harian' => null],
            ['area' => 'TIM', 'name' => 'PAPUA', 'umk' => null, 'total_harian' => null],
            
            ['area' => 'JKT', 'name' => 'HQ', 'umk' => 5396761, 'total_harian' => null],
            ['area' => 'JKS', 'name' => 'JAKARTA', 'umk' => 5396761, 'total_harian' => null],
            ['area' => 'JST', 'name' => 'Jakarta', 'umk' => 5396761, 'total_harian' => null],
            ['area' => 'GIA', 'name' => 'Bali', 'umk' => 3119080, 'total_harian' => null],
            ['area' => 'JRT', 'name' => 'JAKARTA', 'umk' => 5396761, 'total_harian' => null],
            ['area' => 'BOO', 'name' => 'JAWA BARAT', 'umk' => 5126897, 'total_harian' => null],
            ['area' => 'SRI', 'name' => 'KALIMANTAN TIMUR', 'umk' => 3724437, 'total_harian' => null],
            ['area' => 'MDR', 'name' => 'JAWA TIMUR', 'umk' => 4961753, 'total_harian' => null],
            ['area' => 'BDO', 'name' => 'JAWA BARAT', 'umk' => 4482914, 'total_harian' => null],
            ['area' => 'JKT', 'name' => 'HQ', 'umk' => 5396761, 'total_harian' => null],
            ['area' => 'TGR', 'name' => 'TANGERANG', 'umk' => 5069708, 'total_harian' => null],
        ];
        DB::table('area_payrolls')->insert($data);
    }
}

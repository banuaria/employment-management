<?php

namespace Database\Seeders;

use App\Models\Term;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::role('admin')->inRandomOrder()->first();

        Term::create([
            'updated_by' => $user->id,
        ]);
    }
}

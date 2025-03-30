<?php

namespace Database\Seeders;

use App\Models\Policy;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::role('admin')->inRandomOrder()->first();

        Policy::create([
            'updated_by' => $user->id,
        ]);
    }
}

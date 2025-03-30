<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'status' => true,
        ]);
        $admin->assignRole('admin');

        $editor = User::factory()->create([
            'name' => 'Editor User',
            'email' => 'editor@techad.com',
            'status' => true,
        ]);
        $editor->assignRole('editor');
    }
}

<?php

namespace Database\Seeders;

use App\Models\PostSubcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostSubcategory::factory(4)->create();
    }
}

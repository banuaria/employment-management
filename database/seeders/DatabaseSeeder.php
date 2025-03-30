<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            ConfigSeeder::class,
            TestimonySeeder::class,
            LocationCategorySeeder::class,
            LocationSeeder::class,
            PostCategorySeeder::class,
            PostSubcategorySeeder::class,
            PostSeeder::class,
            PostTagSeeder::class,
            ContactSeeder::class,
            AboutSeeder::class,
            TermSeeder::class,
            PolicySeeder::class,
            FaqCategorySeeder::class,
            FaqSeeder::class,
            ProductCategorySeeder::class,
            ProductSubcategorySeeder::class,
            ProductSeeder::class,
            ProductTagSeeder::class,
        ]);
    }
}

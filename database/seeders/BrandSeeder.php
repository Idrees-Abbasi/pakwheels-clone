<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // DB facade import

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
    DB::table('brands')->insert([
    ['name' => 'Toyota'],
    ['name' => 'Honda'],
    ['name' => 'Suzuki'],
    ['name' => 'Kia'],
]);

    }
    
}


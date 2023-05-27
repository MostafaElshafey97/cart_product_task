<?php

namespace Database\Seeders;
use App\Models\Country;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::create([
            'name' => 'US',
            'shipping_rate' => 2
        ]);
    
        Country::create([
            'name' => 'UK',
            'shipping_rate' => 3
        ]);
    
        Country::create([
            'name' => 'CN',
            'shipping_rate' => 2
        ]);
    
    }
}

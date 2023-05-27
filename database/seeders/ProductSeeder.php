<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'T-Shirt',
                'price' => 30.99,
                'shipping_country' => 'USA',
                'weight' => 0.2,
            ],
            [
                'name' => 'Blouse',
                'price' => 10.99,
                'shipping_country' => 'UK',
                'weight' => 0.3,
            ],
            [
                'name' => 'Pants',
                'price' => 64.99,
                'shipping_country' => 'UK',
                'weight' => 0.9,
            ],
            [
                'name' => 'Sports Pants',
                'price' => 84.99,
                'shipping_country' => 'China',
                'weight' => 1.1,
            ],
            [
                'name' => 'Jacket',
                'price' => 199.99,
                'shipping_country' => 'USA',
                'weight' => 2.2,
            ],
            [
                'name' => 'Shoes',
                'price' => 79.99,
                'shipping_country' => 'China',
                'weight' => 1.3,
            ],
        ]);
    }
}
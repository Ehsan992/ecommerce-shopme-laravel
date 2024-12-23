<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'category_id' => 1, // Provide the category ID here
            // Add other column values as needed
            'name' => 'Product Name',
            'description' => 'Product Description',
            // Add more columns here
        ]);
    }
}

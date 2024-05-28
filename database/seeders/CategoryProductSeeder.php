<?php

namespace Database\Seeders;

use App\Models\Category_Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category_Product::insert([
            [
                'category_id' => '1',
                'product_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '1',
                'product_id' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '2',
                'product_id' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '2',
                'product_id' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '1',
                'product_id' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '3',
                'product_id' => '5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '3',
                'product_id' => '6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '3',
                'product_id' => '7',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '4',
                'product_id' => '8',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '4',
                'product_id' => '9',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '5',
                'product_id' => '10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '5',
                'product_id' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

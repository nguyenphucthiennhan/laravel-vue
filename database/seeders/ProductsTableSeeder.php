<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Product;


class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Factory::create();
        foreach (range(1,10) as $index) {
            Product::insert([
                'name' => $faker->word,
                'description' => $faker->paragraph,
                'price' => $faker->randomNumber(3),
                'status' => true,
                'discount' => 0,
                'download' =>0,
                'like' => 0,
                'comment' =>0,
                 'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

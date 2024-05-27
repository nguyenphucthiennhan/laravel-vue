<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image; 

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Image::insert([
            [
                'name' => 'top-game-01.jpg',
                'product_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'top-game-02.jpg',
                'product_id' => 2, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'top-game-03.jpg',
                'product_id' => 3,
                 'created_at' => now(),
                'updated_at' => now(), 
            ],
            [
                'name' => 'top-game-04.jpg',
                'product_id' => 4,
                 'created_at' => now(),
                'updated_at' => now(), 
            ],
            [
                'name' => 'top-game-05.jpg',
                'product_id' => 5,
                 'created_at' => now(),
                'updated_at' => now(), 
            ],
            [
                'name' => 'top-game-06.jpg',
                'product_id' => 6,
                 'created_at' => now(),
                'updated_at' => now(), 
            ],
            [
                'name' => 'trending-01.jpg',
                'product_id' => 7,
                 'created_at' => now(),
                'updated_at' => now(), 
            ],
            [
                'name' => 'trending-02.jpg',
                'product_id' => 8,
                 'created_at' => now(),
                'updated_at' => now(), 
            ],
            [
                'name' => 'trending-03.jpg',
                'product_id' => 9,
                 'created_at' => now(),
                'updated_at' => now(), 
            ],
            [
                'name' => 'trending-04.jpg',
                'product_id' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
           
        ]);
    }
}

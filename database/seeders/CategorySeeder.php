<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category::insert([
            [
                'name' => 'Action',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Adventure',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Shooter',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Battle Royale',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Strategy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

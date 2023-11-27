<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = ['Наукова література', 'Художня література', 'Дитяча література', 'Інше'];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}

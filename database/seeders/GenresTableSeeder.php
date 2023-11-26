<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = ['Adventure', 'Romance', 'Fantasy', 'Horror', 'Biography'];

        foreach ($genres as $genre) {
            Genre::create(['name' => $genre]);
        }
    }
}
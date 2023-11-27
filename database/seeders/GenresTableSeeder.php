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
        $genres = ['Фентезі', 'Детектив', 'Пригоди', 'Роман', 'Драма', 'Історичний', 'Наукова фантастика', 'Жахи', 'Комедія', 'Трилер', 'Бойовик', 'Фантастика', 'Поезія', 'Психологія', 'Публіцистика', 'Релігія', 'Саморозвиток', 'Спорт', 'Техніка', 'Туризм', 'Філософія', 'Хобі', 'Юмор', 'Іноземна література', 'Інше'];

        foreach ($genres as $genre) {
            Genre::create(['name' => $genre]);
        }
    }
}

<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    protected $model = Author::class;

    public function definition()
    {
        // Creating a custom Faker instance for Ukrainian
        $faker = \Faker\Factory::create('uk_UA');

        return [
            'name' => $faker->unique()->name,
            'biography' => $faker->text,
            'image' => $faker->imageUrl(640, 480, 'people'), // Generates a random image URL. You might want to use real images or a different placeholder service.
        ];
    }
}

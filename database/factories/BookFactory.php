<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition() {
        $languages = ['Англійська', 'Українська', 'Німецька', 'Французька', 'Іспанська', 'Італійська', 'Польська', 'Чеська', 'Китайська', 'Японська', 'Корейська', 'Інша'];

        return [
            'user_id' => User::factory(), // Assumes a UserFactory exists
            'category_id' => Category::inRandomOrder()->first()->id, // Fetch a random category_id
            'genre_id' => Genre::inRandomOrder()->first()->id, // Fetch a random genre_id
            'author_id' => Author::factory(), // Assumes an AuthorFactory exists
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'image' => $this->fetchUnsplashImageUrl(),
            'isbn' => $this->faker->isbn13,
            'language' => $this->faker->randomElement($languages),
            'publisher' => $this->faker->company,
            'year' => $this->faker->year,
            'pages' => $this->faker->numberBetween(100, 500),
        ];
    }

    /**
     * Fetches a random image URL from Unsplash
     */
    protected function fetchUnsplashImageUrl()
    {
        $client = new \GuzzleHttp\Client();
        $accessKey = '-RBT5xxZ7jFCwxGhgrkXuyW4HHgLc7L9WEcMG_htAbk';

        try {
            $response = $client->request('GET', 'https://api.unsplash.com/photos/random', [
                'query' => [
                    'client_id' => $accessKey,
                    'query' => 'book cover',
                    'orientation' => 'portrait',
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            return $data['urls']['regular']; // You can adjust this key based on the size you need
        } catch (\Exception $e) {
            // Fallback URL or error handling
            return 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png'; // Provide a default image URL
        }
    }

}

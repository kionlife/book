<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /*
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('genre_id');
            $table->unsignedBigInteger('author_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('isbn')->nullable();
            $table->string('language')->nullable();
            $table->string('publisher')->nullable();
            $table->string('year')->nullable();
            $table->string('pages')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
        */

        $books = [
            [
                'user_id' => 1,
                'category_id' => 1,
                'genre_id' => 1,
                'author_id' => 1,
                'title' => 'The Hobbit',
                'description' => 'The Hobbit, or There and Back Again is a children\'s fantasy novel by English author J. R. R. Tolkien. It was published on 21 September 1937 to wide critical acclaim, being nominated for the Carnegie Medal and awarded a prize from the New York Herald Tribune for best juvenile fiction. The book remains popular and is recognized as a classic in children\'s literature.',
                'image' => 'https://upload.wikimedia.org/wikipedia/en/3/30/The_Hobbit_cover.JPG',
                'isbn' => '978-0-618-34625-6',
                'language' => 'English',
                'publisher' => 'George Allen & Unwin',
                'year' => '1937',
                'pages' => '310',
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'genre_id' => 1,
                'author_id' => 1,
                'title' => 'The Lord of the Rings',
                'description' => 'The Lord of the Rings is an epic high fantasy novel by the English author and scholar J. R. R. Tolkien. Set in Middle-earth, the world at some distant time in the past, the story began as a sequel to Tolkien\'s 1937 children\'s book The Hobbit, but eventually developed into a much larger work. Written in stages between 1937 and 1949, The Lord of the Rings is one of the best-selling books ever written, with over 150 million copies sold.',
                'image' => 'https://upload.wikimedia.org/wikipedia/en/8/8e/The_Lord_of_the_Rings_1954_cover.jpg',
                'isbn' => '978-0-618-34625-6',
                'language' => 'English',
                'publisher' => 'George Allen & Unwin',
                'year' => '1954',
                'pages' => '1216',
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'genre_id' => 1,
                'author_id' => 1,
                'title' => 'The Silmarillion',
                'description' => 'The Silmarillion is a collection of mythopoeic works by English writer J. R. R. Tolkien, edited and published posthumously by his son, Christopher Tolkien, in 1977, with assistance from Guy Gavriel Kay. The Silmarillion, along with J. R. R. Tolkien\'s other works, forms an extensive, though incomplete, narrative that describes the universe of Eä in which are found the lands of Valinor, Beleriand, Númenor, and Middle-earth, within which The Hobbit and The Lord of the Rings take place.',
                'image' => 'https://upload.wikimedia.org/wikipedia/en/0/01/The_Silmarillion_1977_UK_cover.jpg',
                'isbn' => '978-0-618-34625-6',
                'language' => 'English',
                'publisher' => 'George Allen & Unwin',
                'year' => '1977',
                'pages' => '365',
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'genre_id' => 1,
                'author_id' => 1,
                'title' => 'The Children of Húrin',
                'description' => 'The Children of Húrin is an epic fantasy novel which forms the completion of a tale by J. R. R. Tolkien. He wrote the original version of the story in the late 1910s, revised it several times later, but did not complete it before his death in 1973. His son, Christopher Tolkien, edited the manuscripts to form a consistent narrative, and published it in 2007 as an independent work.',
                'image' => 'https://upload.wikimedia.org/wikipedia/en/6/6d/The_Children_of_Hurin_cover.jpg',
                'isbn' => '978-0-618-34625-6',
                'language' => 'English',
                'publisher' => 'George Allen & Unwin',
                'year' => '2007',
                'pages' => '313',
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'genre_id' => 1,
                'author_id' => 1,
                'title' => 'The Fall of Gondolin',
                'description' => 'The Fall of Gondolin is, in the writings of J.R.R. Tolkien, one of the original Lost Tales which formed the basis for a section in his later work, The Silmarillion. A stand-alone, book-length version of the story was published on 30 August 2018.',
                'image' => 'https://upload.wikimedia.org/wikipedia/en/6/6d/The_Children_of_Hurin_cover.jpg',
                'isbn' => '978-0-618-34625-6',
                'language' => 'English',
                'publisher' => 'George Allen & Unwin',
                'year' => '2018',
                'pages' => '304',
            ]
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}

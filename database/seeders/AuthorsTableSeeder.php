<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /*
            $table->id();
            $table->string('name')->unique();
            $table->text('biography')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        */

        $authors = [
            [
                'name' => 'J. K. Rowling',
                'biography' => 'Joanne Rowling CH, OBE, HonFRSE, FRCPE, FRSL, better known by her pen name J. K. Rowling, is a British author, philanthropist, film producer, television producer, and screenwriter. She is best known for writing the Harry Potter fantasy series, which has won multiple awards and sold more than 500 million copies, becoming the best-selling book series in history. The books are the basis of a popular film series, over which Rowling had overall approval on the scripts and was a producer on the final films. She also writes crime fiction under the pen name Robert Galbraith.',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5d/J._K._Rowling_2010.jpg/440px-J._K._Rowling_2010.jpg',
            ],
            [
                'name' => 'Stephen King',
                'biography' => 'Stephen Edwin King is an American author of horror, supernatural fiction, suspense, crime, science-fiction, and fantasy novels. His books have sold more than 350 million copies, and many have been adapted into films, television series, miniseries, and comic books. King has published 61 novels, including seven under the pen name Richard Bachman, and five non-fiction books. He has also written approximately 200 short stories, most of which have been published in book collections.',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e3/Stephen_King%2C_Comicon.jpg/440px-Stephen_King%2C_Comicon.jpg',
            ],
            [
                'name' => 'J. R. R. Tolkien',
                'biography' => 'John Ronald Reuel Tolkien CBE FRSL was an English writer, poet, philologist, and academic. He was the author of the high fantasy works The Hobbit and The Lord of the Rings.',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/89/Tolkien_1916.jpg/440px-Tolkien_1916.jpg',
            ],
            [
                'name' => 'George R. R. Martin',
                'biography' => 'George Raymond Richard Martin, also known as GRRM, is an American novelist and short story writer, screenwriter, and television producer. He is the author of the series of epic fantasy novels A Song of Ice and Fire, which was adapted into the Emmy Award-winning HBO series Game of Thrones.',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/93/George_R._R._Martin_2019.jpg/440px-George_R._R._Martin_2019.jpg',
            ],
        ];

        foreach ($authors as $author) {
            \App\Models\Author::create($author);
        }
    }
}

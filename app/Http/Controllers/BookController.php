<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookInstance;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
        //Get books with category and genre and paginate them
        $books = Book::with('category', 'genre', 'author')->paginate(12);
        return response()->json($books);
    }

    public function last() {
        $books = Book::with('category', 'genre', 'author')->latest()->take(3)->get();
        return response()->json($books);
    }

    public function byGenre($id) {
        $books = Book::with('category', 'genre', 'author')->where('genre_id', $id)->take(4)->get();
        return response()->json($books);
    }

    public function my() {
        $user = auth()->user();
        $books = BookInstance::with('book.category', 'book.genre', 'book.author')->where('current_user_id', $user->id)->get();
        return response()->json($books);
    }

    public function show($id) {
        $book = Book::with('category', 'genre', 'author', 'instance', 'instance.current')->findOrFail($id);
        return response()->json($book);
    }

    public function createInstance(Request $request) {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->input('book_id'));

        $instance = BookInstance::create([
            'book_id' => $book->id,
            'user_owner_id' => auth()->user()->id,
            'current_user_id' => auth()->user()->id,
            'description' => $request->input('description') ?? '',
        ]);

        return response()->json($instance, 201);
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'genre_id' => 'required|exists:genres,id',
            'description' => 'required|string',
            'image' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $book = Book::create($request->all());

        return response()->json($book, 201);
    }

    public function search(Request $request) {
        $request->validate([
            'term' => 'required|string|max:255',
        ]);

        $query = $request->input('term');

        $books = Book::with('author')
            ->where('title', 'LIKE', "%{$query}%")
            ->orWhere('isbn', 'LIKE', "%{$query}%")
            ->take(10)
            ->get();

        return response()->json($books);
    }

    // Add methods for creating, updating, and deleting books as per your needs
}

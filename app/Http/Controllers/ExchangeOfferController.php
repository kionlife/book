<?php

namespace App\Http\Controllers;

use App\Models\BookInstance;
use App\Models\ExchangeOffer;
use Illuminate\Http\Request;

class ExchangeOfferController extends Controller {

    public function index() {
        $offers = ExchangeOffer::all();

        return response()->json($offers, 200);
    }

    public function my() {
        $user = auth()->user();
        $offers = ExchangeOffer::with('instance.book.category', 'instance.book.genre', 'instance.book.author', 'fromUser', 'toUser')->where('from_user_id', $user->id)->orWhere('to_user_id', $user->id)->get();

        return response()->json($offers, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'book_instance_id' => 'required|exists:book_instances,id',
            'city' => 'string|max:255',
        ]);

        $book_instance = BookInstance::findOrFail($request->input('book_instance_id'));

        $data = [
            'book_instance_id' => $book_instance->id,
            'from_user_id' => $book_instance->current_user_id,
            'to_user_id' => auth()->user()->id,
            'city' => 'NONE',
            'status' => 'pending',
        ];

        $offer = ExchangeOffer::create($data);

        return response()->json($offer, 201);
    }

    // Add additional methods as necessary, such as for viewing and accepting offers

    public function accept(Request $request, $id) {
        $offer = ExchangeOffer::findOrFail($id);
        $offer->status = 'accepted';
        $offer->save();


        return response()->json($offer, 200);
    }
}

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
        $offers = ExchangeOffer::with('give_book.book', 'take_book.book', 'fromUser', 'toUser')->where('to_user_id', $user->id)->get();

        return response()->json($offers, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'give_book_instance_id' => 'required|exists:book_instances,id',
            'take_book_instance_id' => 'required|exists:book_instances,id',
            'city' => 'string|max:255',
        ]);

        $give_book_instance = BookInstance::findOrFail($request->input('give_book_instance_id'));
        $take_book_instance = BookInstance::findOrFail($request->input('take_book_instance_id'));

        $data = [
            'give_book_instance_id' => $give_book_instance->id,
            'from_user_id' => auth()->user()->id,
            'take_book_instance_id' => $take_book_instance->id,
            'to_user_id' => $take_book_instance->current_user_id,
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
        BookInstance::where('id', $offer->give_book_instance_id)->update(['current_user_id' => $offer->to_user_id]);
        BookInstance::where('id', $offer->take_book_instance_id)->update(['current_user_id' => $offer->from_user_id]);
        self::my();
    }
}

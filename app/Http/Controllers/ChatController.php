<?php

// app/Http/Controllers/ChatController.php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\ExchangeOffer;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller {

    public function getUsers() {
        $userId = auth()->id();

        $exchangeUserIds = ExchangeOffer::where('from_user_id', $userId)
            ->orWhere('to_user_id', $userId)
            ->get()
            ->map(function ($offer) use ($userId) {
                return $offer->from_user_id == $userId ? $offer->to_user_id : $offer->from_user_id;
            })
            ->toArray();

        $messageUserIds = Message::where('user_id', $userId)
            ->orWhere('to_user_id', $userId)
            ->get()
            ->map(function ($message) use ($userId) {
                return $message->user_id == $userId ? $message->to_user_id : $message->user_id;
            })
            ->toArray();

        $uniqueUserIds = array_unique(array_merge($exchangeUserIds, $messageUserIds));
        $uniqueUserIds = array_diff($uniqueUserIds, [$userId]);

        $users = User::whereIn('id', $uniqueUserIds)->get();

        return response()->json($users, 200);
    }

    public function fetchMessages(Request $request) {
        $messages = Message::where('user_id', $request->userId)
            ->orWhere('user_id', $request->toUserId)
            ->orWhere('to_user_id', $request->userId)
            ->orWhere('to_user_id', $request->toUserId)
            ->orderBy('id', 'ASC')->with('user')->get();

        return response()->json($messages, 200);
    }

    public function sendMessage(Request $request)
    {
        $user = auth()->user();
        $message = $user->messages()->create([
            'message' => $request->message,
            'to_user_id' => $request->toUserId
        ]);

        // Ensure you're loading the user relationship if it's not automatically loaded
        $message->load('user');

        broadcast(new MessageSent($message, $request->toUserId))->toOthers();

        // Return the message and the user in separate keys
        return ['message' => $message, 'user' => $user];
    }

}

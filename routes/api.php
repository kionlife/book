<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ExchangeOfferController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('books/my', [BookController::class, 'my']);
    Route::post('books/instance', [BookController::class, 'createInstance']);

    // Exchange offers endpoints
    Route::get('/exchange-offers/my', [ExchangeOfferController::class, 'my']);
    Route::post('/exchange-offers', [ExchangeOfferController::class, 'store']);
    Route::post('/exchange-offers/{id}/accept', [ExchangeOfferController::class, 'accept']);
    Route::post('/exchange-offers/{id}/reject', [ExchangeOfferController::class, 'reject']);
    Route::post('/user/update', [UserController::class, 'update']);

    Route::get('/messages', [ChatController::class, 'fetchMessages']);
    Route::post('/messages', [ChatController::class, 'sendMessage']);
    Route::get('/messages/users', [ChatController::class, 'getUsers']);

});

Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Books endpoints
Route::get('books/last', [BookController::class, 'last']);
Route::get('books/search', [BookController::class, 'search']);
Route::get('books/genre/{id}', [BookController::class, 'byGenre']);
Route::apiResource('books', BookController::class);

Route::get('genres', [BookController::class, 'genres']);
Route::get('authors', [BookController::class, 'authors']);
Route::get('categories', [BookController::class, 'categories']);

Route::get('check-auth', function () {
    return response()->json(['message' => 'Authenticated'], 200);
})->middleware('auth:sanctum');

Broadcast::routes(['middleware' => ['auth:sanctum']]);


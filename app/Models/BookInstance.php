<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookInstance extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'user_owner_id'
    ];

    public function book() {
        return $this->belongsTo(Book::class);
    }

    public function owner() {
        return $this->belongsTo(User::class, 'user_owner_id');
    }

    public function current() {
        return $this->hasOne(User::class, 'id', 'current_user_id');
    }

    public function exchangeLogs() {
        return $this->hasMany(BookExchangeLog::class);
    }

    public function exchangeOffers() {
        return $this->hasMany(ExchangeOffer::class);
    }



}

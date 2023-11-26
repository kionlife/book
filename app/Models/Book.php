<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function genre() {
        return $this->belongsTo(Genre::class);
    }

    public function exchangeOffers() {
        return $this->hasMany(ExchangeOffer::class);
    }

    public function author() {
        return $this->belongsTo(Author::class);
    }

    public function instance() {
        return $this->hasMany(BookInstance::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookExchangeLog extends Model
{
    use HasFactory;

    public function bookInstance() {
        return $this->belongsTo(BookInstance::class);
    }

    public function user_giver() {
        return $this->belongsTo(User::class, 'user_from_id');
    }

    public function user_receiver() {
        return $this->belongsTo(User::class, 'user_to_id');
    }
}

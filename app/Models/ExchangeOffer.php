<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_user_id',
        'give_book_instance_id',
        'to_user_id',
        'take_book_instance_id',
        'city',
        'status',
    ];

    public function give_book() {
        return $this->belongsTo(BookInstance::class, 'give_book_instance_id');
    }

    public function take_book() {
        return $this->belongsTo(BookInstance::class, 'take_book_instance_id');
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
}

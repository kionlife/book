<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_instance_id',
        'from_user_id',
        'to_user_id',
        'city',
        'status',
    ];

    public function instance() {
        return $this->belongsTo(BookInstance::class, 'book_instance_id');
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

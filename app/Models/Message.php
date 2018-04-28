<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Message extends Model
{
    protected $fillable = [
        'user_id',
        'seminar_id',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(Message::class);
    }
}

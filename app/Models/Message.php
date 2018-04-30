<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modes\Seminar;
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
        return $this->belongsTo(User::class);
    }

    public function seminar()
    {
    	return $this->belongsTo(Seminar::class);
    }

    public function scopeGetMessageWithUser($query, $id)
    {
        return $query->where('id', $id)
                    ->with('user');
    }
}

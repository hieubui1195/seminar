<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Notification extends Model
{
    protected $fillable = [
        'user_send_id',
        'user_receive_id',
        'target_id',
        'viewed',
        'type',
        'status'
    ];

    public function userSend()
    {
        return $this->belongsTo(User::class, 'user_send_id');
    }

    public function userReceive()
    {
        return $this->belongsTo(User::class, 'user_receive_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;

Relation::morphMap([
    'call' => 'App\Models\Call',
    'seminar' => 'App\Models\Seminar',
]);

class Notification extends Model
{
    protected $fillable = [
        'user_send_id',
        'user_receive_id',
        'target_id',
        'viewed',
        'notification_type',
        'notification_id',
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

    public function notification()
    {
        return $this->morphTo();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Notification;

class Call extends Model
{
    protected $fillable = [
        'caller',
        'receiver',
        'status',
    ];

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notification');
    }
}

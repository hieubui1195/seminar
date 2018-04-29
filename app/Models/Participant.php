<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seminar;
use App\Models\User;

class Participant extends Model
{
    protected $fillable = [
        'seminar_id',
        'user_id',
        'status',
    ];

    public function seminar()
    {
        return $this->belongsTo(Seminar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

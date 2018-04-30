<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Participant;
use App\Models\User;

class Seminar extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'description',
        'start',
        'end',
        'code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function scopeWithUser($query, $id)
    {
        return $this->where('id', $id)->with('user');
    }
}

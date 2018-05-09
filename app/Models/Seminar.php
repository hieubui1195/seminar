<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Message;
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

    protected $hidden = [
        'code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'messages')
                    ->withPivot('message')->withTimestamps()
                    ->orderBy('messages.created_at', 'asc');
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function scopeGetAllWithUser($query)
    {
        return $query->with('user')->get();
    }

    public function scopeWithUser($query, $id)
    {
        return $query->where('id', $id)->with('user');
    }

    public function scopeWithUserAndMessages($query, $id)
    {
        return $query->where('id', $id)->with('user', 'messages');
    }

    public function scopeListActive($query)
    {
        return $query->where('start', '<=', Carbon::now())
                    ->where('end', '>=', Carbon::now())
                    ->with('user')
                    ->orderBy('start', 'asc');
    }

    public function scopeListEarly($query)
    {
        return $query->where('start', '>', Carbon::now())
                    ->with('user')
                    ->orderBy('start', 'asc');
    }

    public function scopeListFinished($query)
    {
        return $query->where('end', '<', Carbon::now())
                    ->with('user')
                    ->orderBy('start', 'asc');
    }
}

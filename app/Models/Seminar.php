<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Carbon\Carbon;
use App\Models\Message;
use App\Models\Participant;
use App\Models\User;
use App\Models\Report;
use App\Models\Notification;

class Seminar extends Model
{
    use Searchable;

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

    public function searchableAs()
    {
        return 'search_application';
    }

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

    public function report()
    {
        return $this->hasOne(Report::class);
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notification');
    }

    public function scopeGetAllWithUser($query)
    {
        return $query->orderBy('created_at', 'desc')->with('user')->get();
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
                    ->orderBy('created_at', 'desc');
    }

    public function scopeListEarly($query)
    {
        return $query->where('start', '>', Carbon::now())
                    ->with('user')
                    ->orderBy('created_at', 'desc');
    }

    public function scopeListFinished($query)
    {
        return $query->where('end', '<', Carbon::now())
                    ->with('user')
                    ->orderBy('created_at', 'desc');
    }

    public function scopeGetSeminarWithReport($query, $id)
    {
        return $query->where('id', $id)->with('report');
    }
}

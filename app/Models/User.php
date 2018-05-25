<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Message;
use App\Models\Seminar;
use App\Models\Notification;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use Notifiable;

    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'level',
        'phone',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function searchableAs()
    {
        return 'search_application';
    }

    public function seminars()
    {
        return $this->hasMany(Seminar::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_receive_id')->orderBy('created_at', 'desc');
    }

    public function scopeOrderUser($query)
    {
        return $query->orderBy('name');
    }
}

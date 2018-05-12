<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seminar;
use App\Models\User;

class Report extends Model
{
    protected $fillable = [
        'seminar_id',
        'user_id',
        'report',
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

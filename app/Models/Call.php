<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    protected $fillable = [
        'caller',
        'receiver',
        'status',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_login_at'
    ];

    protected $dates = [
        'last_login_at'
    ];
}

<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'enrollment_no',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    // VERY IMPORTANT 
    public $timestamps = false;
}

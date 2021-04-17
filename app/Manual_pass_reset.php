<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manual_pass_reset extends Model
{
    protected $fillable = [
        'email', 'token'
    ];
}

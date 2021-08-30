<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $fillable = [
        'name', 'points_num', 'type', 'status'
    ];
}

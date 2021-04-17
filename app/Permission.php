<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['user_id', 'users', 'clients', 'addcases', 'search_case', 'mohdreen',
    'category', 'daily_report', 'monthly_report'];


    public function getUser()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}

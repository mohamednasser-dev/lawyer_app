<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client_Note extends Model
{
    protected $fillable = [
        'client_id', 'notes','user_id','parent_id'
    ];

    public function  user_id(){

        return $this->hasOne('App\User','id','user_id');

    }
    //api
    public function  user(){

        return $this->hasOne('App\User','id','user_id')->select('id','name');

    }
    public function  Client(){

        return $this->hasOne('App\Clients','id','client_id');

    }
}

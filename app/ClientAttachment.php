<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientAttachment extends Model
{
    protected $fillable = [
        'client_Id', 'img_Url', 'img_Description', 'parent_id'
    ];

    public function  getClient(){

        return $this->hasOne('App\Clients','id','client_Id');

    }


    public function  client(){

        return $this->hasOne('App\Clients','id','client_Id')->select('id','client_Name');

    }


}

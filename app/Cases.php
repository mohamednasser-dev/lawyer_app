<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    protected $table = 'cases';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'mokel_name', 'khesm_name', 'invetation_num', 'circle_num', 'court', 'first_session_date',
        'inventation_type', 'to_whome', 'month', 'year', 'parent_id'
    ];
    protected $attributes = ['one_session_note' => ''];

    public function clients()
    {
        return $this->belongsToMany(Clients::class, 'case_clients', 'case_id', 'client_id');
    }


    public function Clients_custom()
    {
        return $this->belongsToMany(Clients::class, 'case_clients', 'case_id', 'client_id')->select('client_Name');
    }


    public function Clients_only()
    {
        return $this->belongsToMany(Clients::class, 'case_clients', 'case_id', 'client_id')->select('client_Name')->where('type','client');
    }
    public function khesm_only()
    {
        return $this->belongsToMany(Clients::class, 'case_clients', 'case_id', 'client_id')->select('client_Name')->where('type','khesm');
    }

    public function category()
    {
        return $this->hasOne('App\category', 'id', 'to_whome')->select('id','name');
    }

    public function to_whome()
    {
        return $this->hasOne('App\category', 'id', 'to_whome');
    }
}

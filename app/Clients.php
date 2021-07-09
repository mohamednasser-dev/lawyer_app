<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $hidden = ['pivot'];

    protected $fillable = [
        'client_Name', 'client_Unit', 'client_Address', 'notes', 'type' ,'cat_id','parent_id',
    ];

    public function  cat_id(){

        return $this->hasOne('App\category','id','cat_id');

    }

    public function cases()
    {
        return $this->belongsToMany(Cases::class, 'case_clients', 'client_id', 'case_id')->with('category')
            ->select('cases.id','invetation_num','inventation_type','circle_num','court','first_session_date','to_whome');
    }
    public function client_notes()
    {
        return $this->hasMany('App\Client_Note','client_id','id')->select(['id','notes as note','user_id','client_id']);
    }

    public function  category()
    {
        return $this->belongsTo('App\category','cat_id')->select('id','name');
    }



    public function getTypeAttribute($value)
    {
        if ($value == 'client') {
            return trans('site_lang.clients_client_type_client');
        } else {
            return trans('site_lang.clients_client_type_khesm');
        }
    }
}

<?php

namespace App;

use App\Cases;
use Illuminate\Database\Eloquent\Model;

class Case_client extends Model
{
    protected $fillable = [
        'case_id', 'client_id'
    ];
    protected $hidden = ['created_at', 'updated_at'];
//    protected $appends = ['client_Name', 'client_type','id'];

    public function case()
    {
        return $this->belongsTo(Cases::class, 'case_id');
    }

    public function client()
    {
        return $this->belongsTo(Clients::class, 'client_id');
    }

    public function client_data()
    {
        return $this->belongsTo(Clients::class, 'client_id')->select('id', 'client_Name','cat_id');
    }

    public function getClientNameAttribute()
    {
        return $this->client()->first()->client_Name;
    }

    public function getClientTypeAttribute()
    {
        return $this->client()->first()->type;
    }

}

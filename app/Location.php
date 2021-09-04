<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name','address','lat','long','type','status','government_id'
    ];


    public function getTypeAttribute($value)
    {
        if ($value == 'Court') {
            return trans('site_lang.Court');
        } else if ($value == 'Police_station'){
            return trans('site_lang.Police_station');
        }else if ($value == 'Real_estate_month'){
            return trans('site_lang.real_estate_month');
        }
    }
}

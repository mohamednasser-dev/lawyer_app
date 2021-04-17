<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mohdr extends Model
{
    protected $primaryKey = "moh_Id";
    protected $fillable = [
        'moh_id', 'court_mohdareen', 'paper_type', 'deliver_data', 'paper_Number', 'session_Date', 'mokel_Name', 'khesm_Name', 'case_number','cat_id','parent_id'
        ,'notes'
    ];

    public function  category(){

        return $this->hasOne('App\category','id','cat_id')->select('name','id');

    }

    public function getStatusAttribute($value)
    {
        if ($value == 'No') {
            return trans('site_lang.public_no_text');
        } else {
            return trans('site_lang.public_yes_text');
        }
    }
}

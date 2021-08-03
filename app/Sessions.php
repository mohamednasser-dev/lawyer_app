<?php

namespace App;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    protected $table = 'sessions';
    protected $fillable = ['session_date', 'case_Id', 'month', 'year', 'status', 'parent_id'];
    protected $attributes = ['status' => 'No'];

    public function cases()
    {
        return $this->belongsTo(Cases::class, 'case_Id');
    }

    public function notes()
    {
        return $this->hasMany(Session_Notes::class, 'session_Id');
    }

//    public function lastNote()
//    {
//        return $this->hasOne(Session_Notes::class, 'session_Id')->select('id', 'session_Id', 'note')->latest("note");
//    }

    public function clients()
    {
        return $this->hasMany(Case_client::class, 'case_id', 'case_Id');
    }

    public function Printnotes()
    {
//        return $this->hasOne(Session_Notes::class, 'session_Id');
        return $this->hasOne(Session_Notes::class, 'session_Id')->select('id', 'session_Id', 'note')->latest("note");

    }

    public function Sessions_notes()
    {
        return $this->belongsToMany(Sessions::class, 'session_Id');
    }

    public function getStatusAttribute($value)
    {

        if ($value == 'No') {
            return trans('site_lang.public_no_text');
        } else {
            return trans('site_lang.public_yes_text');
        }
    }

    public function getMonthAttribute($value)
    {
        return Carbon::createFromFormat('m', $value)->translatedformat('F');
    }
}

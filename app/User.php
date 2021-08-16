<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'password','email','cat_id','parent_id','phone','address','package_id','expiry_date','warning_date','expiry_package'
        ,'status','image'
    ];

 public function category(){
        return $this->hasOne('App\category','id','cat_id');
    }
    public function getDuration(){
        return $this->hasOne('App\Package','id','package_id');
    }
    public function  package_id(){

        return $this->hasOne('App\Package','id','package_id');

    }

    public function  Package(){
        return $this->hasOne('App\Package','id','package_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getStatusAttribute($value)
    {

        if ($value == 'Demo') {
            return trans('site_lang.statusDemo');
        } else if ($value == 'Active'){
            return trans('site_lang.statusActive');
        }else{
            return trans('site_lang.statusDeactive');
        }
    }

    public function getExpiryDateAttribute($expire_date)
    {

        if($this->parent_id != null){
           $parent_user =  User::find($this->parent_id);
           return $parent_user->expiry_date;
        }else{
            return $expire_date;
        }
    }

    public function getWarningDateAttribute($warning_date)
    {

        if($this->parent_id != null){
            $parent_user =  User::find($this->parent_id);
            return $parent_user->warning_date;
        }else{
            return $warning_date;
        }
    }
    public function getImageAttribute($image)
    {
//default.png
        if (!empty($image)){
            return  $image;
        }
        return 'default.png';
    }
}

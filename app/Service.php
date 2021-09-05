<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['user_id', 'title', 'price', 'phone', 'whatsapp', 'desc', 'image', 'time'];


    protected $with = ['user'];
    protected $dispatchesEvents = [
        'created' => 'App\Events\ServiceCreated'
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    protected function castAttribute($key, $value)
    {
        if ($this->getCastType($key) == 'string' && is_null($value)) {
            return '';
        }
        return parent::castAttribute($key, $value);
    }

    public function getImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/services') . '/' . $image;
        }
        return "";
    }

    public function setImageAttribute($image)
    {

        if (is_file($image)) {
            $imageFields = upload($image, 'services');
            $this->attributes['image'] = $imageFields;

        }

    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['name', 'type', 'file'];

    public function getFileAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/files') . '/' . $image;
        }
        return '';
    }
}

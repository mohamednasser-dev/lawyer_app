<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class attachment extends Model
{
    protected $table = 'attachments';
    protected $fillable = [
        'img_Url', 'img_Description', 'case_Id','parent_id'
    ];

    protected $appends =['type'] ;

    public function getTypeAttribute()
    {
        return mime_content_type('uploads/attachments/'.$this->img_Url);
    }
}

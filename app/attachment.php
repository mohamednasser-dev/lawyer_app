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
//dd($this->img_Url->getClientOriginalExtension());
        $type = "";
//        if(mime_content_type('uploads/attachments/'.$this->img_Url) =='application/pdf'){
//            $type = 'file';
//        }else {
//            $type = 'image';
//        }
        return mime_content_type('uploads/attachments/'.$this->img_Url);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    protected $fillable = ['title', 'text'];

    public function setTextAttribute($value){
        $this->attributes['text'] = str_replace("\r\n", '</br>', $value);
    }

    public function formattedText()
    {
        return str_replace('</br>', "\r\n", $this->text);
    }
}

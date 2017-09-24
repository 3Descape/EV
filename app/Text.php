<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    protected $fillable = ['title', 'html', 'markup'];

    /**
     * Converts textarea input to valid html linebreaks
     * @method setTextAttribute
     * @param  string $value
     */
    public function setTextAttribute($value){
        $this->attributes['text'] = str_replace("\r\n", '</br>', $value);
    }

    /**
     * Converts the valid html </br> tag back to \r\n for textarea editing
     * @method formattedText
     * @return string
     */
    public function formattedText()
    {
        return str_replace('</br>', "\r\n", $this->text);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    protected $fillable = ['title', 'html', 'markup'];

    /**
     * Returns the images associated with the event
     * @method images
     * @return Illuminte\Database\Eloquent\Collection
     */
    public function images()
    {
        return $this->morphMany('App\Image', 'image');
    }
}

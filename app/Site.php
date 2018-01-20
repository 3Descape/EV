<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = ['title', 'html', 'markup', 'order'];

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

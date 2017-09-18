<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['path', 'thump', 'name', 'description'];

    /**
     * Returns the event the image belongs to.
     * @method event
     * @return Illumiante\Database\Eloquent\Model
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}

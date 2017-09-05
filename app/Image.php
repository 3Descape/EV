<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['path', 'thump', 'name', 'description'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable= ['name','description','date', 'location'];
    protected $dates = [
    'created_at',
    'updated_at',
    'date'
    ];
}

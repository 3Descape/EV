<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    protected $fillable= ['name','description','date', 'location'];
    protected $dates = [
    'created_at',
    'updated_at',
    'date'
    ];

    public function scopeFutureEvents($query)
    {
        return $query->where('date', '>', Carbon::now())->orderBy('date', 'asc');

    }

    public function scopepastEvents($query)
    {
        return $query->where('date', '<', Carbon::now())->orderBy('date', 'desc');

    }
}

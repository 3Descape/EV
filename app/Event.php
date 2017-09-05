<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    protected $fillable = ['name', 'category_id','description','date', 'location', 'category'];
    protected $with = ['category'];
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

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getThumpPathAttribute()
    {
        $image = $this->images->first();
        return  $image ? $image->thump : false;
    }
}

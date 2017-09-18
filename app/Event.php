<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'date',
        'location',
        'category'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'date'
    ];

    protected $with = ['category'];

    /**
     * Filter events that are in the future
     * @method scopeFutureEvents
     * @param  Illuminate\Database\Query\Builder $query
     * @return Illuminte\Database\Query\Builder
     */
    public function scopeFutureEvents($query)
    {
        return $query->where('date', '>', Carbon::now())->orderBy('date', 'asc');
    }

    /**
     * Filter events that are in the past
     * @method scopepastEvents
     * @param  Illuminate\Database\Query\Builder $query
     * @return Illuminte\Database\Query\Builder
     */
    public function scopepastEvents($query)
    {
        return $query->where('date', '<', Carbon::now())->orderBy('date', 'desc');
    }

    /**
     * Returns the images associated with the event
     * @method images
     * @return Illuminte\Database\Eloquent\Collection
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    /**
     * Returns the category the event is associated with
     * @method category
     * @return Illuminte\Database\Eloquent\Model
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Returns the path of the thumbnail image
     * @method getThumpPathAttribute
     * @return string
     */
    public function getThumpPathAttribute()
    {
        $image = $this->images->first();
        return  $image ? $image->thump : false;
    }
}

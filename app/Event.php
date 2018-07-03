<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'event_category_id',
        'html',
        'markup',
        'date',
        'location',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'date'
    ];

    protected $casts = [
        'date' => 'date:Y-m-d H:i',
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
        return $this->morphMany('App\Image', 'image');
    }

    /**
     * Returns the category the event is associated with
     * @method category
     * @return Illuminte\Database\Eloquent\Model
     */
    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'event_category_id');
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

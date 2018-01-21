<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = ['title', 'html', 'markup', 'order', 'site_category_id'];

    /**
     * Returns the images associated with the event
     * @method images
     * @return Illuminte\Database\Eloquent\Collection
     */
    public function images()
    {
        return $this->morphMany('App\Image', 'image');
    }

    public function category()
    {
        return $this->belongsTo(SiteCategory::class, 'site_category_id');
    }
}

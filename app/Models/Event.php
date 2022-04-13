<?php

namespace App\Models;

use App\Tiptap\Tiptap;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory, Tiptap;

    protected $fillable = [
        'name',
        'event_category_id',
        'markup',
        'date',
        'location',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'date',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d H:i',
    ];

    protected $with = ['category'];

    public function scopeFutureEvents($query)
    {
        return $query->where('date', '>', now())->orderBy('date', 'asc');
    }

    public function scopepastEvents($query)
    {
        return $query->where('date', '<', now())->orderBy('date', 'desc');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'image');
    }

    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'event_category_id');
    }

    public function getThumpPathAttribute()
    {
        $image = $this->images->first();

        return  $image ? $image->thump : false;
    }

    public function getDescriptionAttribute()
    {
        return $this->toHtml($this->raw_markup);
    }

    public function getFormattedDateAttribute()
    {
        return $this->date->format('d.m.Y H:i');
    }
}

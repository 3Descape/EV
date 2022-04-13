<?php

namespace App\Models;

use App\Tiptap\Tiptap;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Site extends Model
{
    use HasFactory, Tiptap;

    protected $fillable = [
        'title',
        'markup',
        'order',
        'site_category_id',
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'image');
    }

    public function category()
    {
        return $this->belongsTo(SiteCategory::class, 'site_category_id');
    }

    public function getTextAttribute()
    {
        return $this->toHtml($this->raw_markup);
    }
}

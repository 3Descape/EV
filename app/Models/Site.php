<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'html',
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
}

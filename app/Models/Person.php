<?php

namespace App\Models;

use App\Tiptap\Tiptap;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Person extends Model
{
    use HasFactory, Tiptap;

    protected $table = 'people';

    protected $fillable = [
        'name',
        'markup',
        'email',
        'person_category_id',
        'image_path',
    ];

    public function category()
    {
        return $this->belongsTo(PersonCategory::class, 'person_category_id');
    }

    public function getDescriptionAttribute()
    {
        return $this->toHtml($this->raw_markup);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'people';

    protected $fillable = ['name', 'markup', 'html', 'person_category_id', 'image_path'];

    public function category()
    {
        return $this->belongsTo(PersonCategory::class, 'person_category_id');
    }
}

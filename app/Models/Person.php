<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Person extends Model
{
    use HasFactory;

    protected $table = 'people';

    protected $fillable = [
        'name',
        'markup',
        'html',
        'email',
        'person_category_id',
        'image_path',
    ];

    public function category()
    {
        return $this->belongsTo(PersonCategory::class, 'person_category_id');
    }
}

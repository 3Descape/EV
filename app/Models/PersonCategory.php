<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'has_image',
    ];

    public function people()
    {
        return $this->hasMany(Person::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}

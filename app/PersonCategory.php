<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonCategory extends Model
{
    protected $fillable = ['name', 'has_image'];

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

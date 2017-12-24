<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeopleCategory extends Model
{
    protected $fillable = ['name', 'has_image'];

    public function people()
    {
        return $this->hasMany('App\Person');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}

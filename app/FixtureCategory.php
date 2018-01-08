<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FixtureCategory extends Model
{
    protected $fillable = ['name'];

    public function fixtures()
    {
        return $this->hasMany('App\Fixture');
    }
}

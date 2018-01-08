<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    protected $fillable = ['name', 'description', 'fixture_category_id'];

    public function category()
    {
        return $this->belongsTo('App\FixtureCategory', 'fixture_category_id');
    }
}

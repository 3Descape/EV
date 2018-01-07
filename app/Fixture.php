<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    protected $fillable = ['name', 'description', 'fixture_category_id'];

    public function kategory()
    {
        return $this->belongsTo(FixtureCategory::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $fillable = ['name', 'date', 'category'];

    public function scopeSchoolFree($query)
    {
        return $query->where('category', 'ferien')->get();
    }

    public function scopeSchoolAutonomous($query)
    {
        return $query->where('category', 'schulautonom')->get();
    }

}

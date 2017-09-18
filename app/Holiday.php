<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $fillable = ['name', 'date', 'category'];

    /**
     * Query where holiday is "ferien"
     * @method scopeSchoolFree
     * @param  Illuminate\Database\Query\Builder $query
     * @return Illuminte\Database\Eloquent\Collection
     */
    public function scopeSchoolFree($query)
    {
        return $query->where('category', 'ferien')->get();
    }

    /**
     * Query where holiday is "schulautonom"
     * @method scopeSchoolAutonomous
     * @param  Illuminate\Database\Query\Builder $query
     * @return Illuminte\Database\Eloquent\Collection
     */
    public function scopeSchoolAutonomous($query)
    {
        return $query->where('category', 'schulautonom')->get();
    }

}

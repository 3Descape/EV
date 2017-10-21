<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = "people";

    protected $fillable = ['name', 'description', 'category', 'image_path', 'thump_path'];

    /**
     * Filter people for Ev members
     * @method scopeEVMitglieder
     * @param  Illuminate\Database\Query\Builder $query
     * @return Illuminte\Database\Query\Builder
     */
    public function scopeEVMitglieder($query)
    {
        return $query->where('category', '0')->orderBy('name');
    }

    /**
     * Filter people for SGA members
     * @method scopeSGAMitglieder
     * @param  Illuminate\Database\Query\Builder $query
     * @return Illuminte\Database\Query\Builder
     */
    public function scopeSGAMitglieder($query)
    {
        return $query->where('category', '1')->orderBy('name');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteCategory extends Model
{
    protected $fillable = ['name'];

    /**
     * Return all events that are associated with this category
     * @method events
     * @return Illuminte\Database\Eloquent\Collection
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    /**
     * Returns the name with first letter uppercase
     * @method getNameAttribute
     * @param  string $name
     * @return string
     */
    public function getNameAttribute($name)
    {
        return ucfirst($name);
    }

    /**
     * Converts the name on store to lowercase
     * @method setNameAttribute
     * @param string $name
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = mb_strtolower($name);
    }
}

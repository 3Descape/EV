<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'label'];

    /**
     * Returns the permissions that are associated with this role
     * @method permissions
     * @return Illumiante\Database\Eloquent\Collection
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Returns all users that have this role
     * @method users
     * @return Illumiante\Database\Eloquent\Collection
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Converts the name to lowercase on save
     * @method setNameAttribute
     * @param  string $name
     */
    public function setNameAttribute($name)
    {
        return $this->attributes['name'] = strtolower($name);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'label'];
    protected $hidden = ['pivot'];

    /**
     * Returns the roles this permission is associated with
     * @method roles
     * @return Illumiante\Database\Eloquent\Collection
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Returns the label with first letter uppercase
     * @method getLabelAttribute
     * @param  string $label
     * @return string
     */
    public function getLabelAttribute($label)
    {
        return ucfirst($label);
    }
}

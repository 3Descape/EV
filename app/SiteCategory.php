<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteCategory extends Model
{
    protected $fillable = ['name', 'url'];

    public function sites()
    {
        return $this->hasMany(Site::class);
    }

    public function getRouteKeyName()
    {
        return 'url';
    }
}

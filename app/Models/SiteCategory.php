<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiteCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
    ];

    public function sites()
    {
        return $this->hasMany(Site::class);
    }

    public function getRouteKeyName()
    {
        return 'url';
    }
}

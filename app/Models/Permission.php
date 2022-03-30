<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'label',
    ];

    protected $hidden = ['pivot'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getLabelAttribute($label)
    {
        return ucfirst($label);
    }
}

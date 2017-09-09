<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = "people";

    protected $fillable = ['name', 'description', 'category'];

    public function scopeEVMitglieder($query)
    {
        return $query->where('category', '0')->orderBy('name');
    }

    public function scopeSGAMitglieder($query)
    {
        return $query->where('category', '1')->orderBy('name');
    }
}

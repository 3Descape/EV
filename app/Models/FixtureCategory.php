<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FixtureCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function fixtures()
    {
        return $this->hasMany(Fixture::class);
    }
}

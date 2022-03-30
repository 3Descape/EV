<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Fixture extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'fixture_category_id',
    ];

    public function category()
    {
        return $this->belongsTo(FixtureCategory::class, 'fixture_category_id');
    }
}

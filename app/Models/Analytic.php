<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Analytic extends Model
{
    use HasFactory;

    protected $fillable = [
        'hash',
        'browser_info',
    ];
}

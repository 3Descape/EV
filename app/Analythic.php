<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analythic extends Model
{
    protected $dates = ['created_at'];
    protected $fillable = ['hash', 'browser_info'];
    public $timestamps = false;
}

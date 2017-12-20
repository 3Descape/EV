<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = "people";

    protected $fillable = ['name', 'description', 'people_category_id', 'image_path'];

    public function category(){
        return $this->belongsTo('App\PeopleCategory', 'people_category_id', 'id');
    }
}

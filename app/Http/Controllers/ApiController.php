<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\PersonCategory;

class ApiController extends Controller
{
    public function getPeople(PersonCategory $category)
    {
        $people = $category->people()->orderBy('name')->get();

        return response()->json(['people' => $people], 200);
    }
}

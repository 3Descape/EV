<?php

namespace App\Http\Controllers;

use App\PersonCategory;

class ApiController extends Controller
{
    public function getPeople(PersonCategory $category)
    {
        $people = $category->people()->get();

        return response()->json(['people' => $people], 200);
    }
}

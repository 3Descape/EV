<?php

namespace App\Http\Controllers;

use App\PeopleCategory;

class ApiController extends Controller
{
    public function getPeople(PeopleCategory $category)
    {
        $people = $category->people()->get();

        return response()->json(['people' => $people], 200);
    }
}

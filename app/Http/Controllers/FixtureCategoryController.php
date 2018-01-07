<?php

namespace App\Http\Controllers;

use App\Fixture;
use App\FixtureCategory;
use Illuminate\Http\Request;

class FixtureCategoryController extends Controller
{
    public function index()
    {
        $fixturecategories = FixtureCategory::all();

        return view('admin.sites.fixturekategory.index', compact(
            '$fixturecategories'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:fixtures,name'
        ]);

        FixtureCategory::create([
            'name' => $request->name
        ]);

        return back();
    }

    public function update(Request $request, FixtureCategory $fixturecategory)
    {
        $request->validate([
            'name' => 'required|string|unique:fixture, name'
        ]);

        $fixturecategory->update([
            'name' => $request->name
        ]);

        return back();
    }

    public function destroy(FixtureCategory $fixturecategory)
    {
        $fixturecategory->delete();

        return back();
    }
}

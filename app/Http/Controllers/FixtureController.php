<?php

namespace App\Http\Controllers;

use App\Fixture;
use App\FixtureCategory;
use Illuminate\Http\Request;

class FixtureController extends Controller
{
    public function index()
    {
        $fixturecategories = FixtureCategory::with('fixtures')->get();

        return view('admin.sites.fixture.index', compact(
            'fixturecategories'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required',
            'fixture_category' => 'required|exists:fixture_categories,id'
        ]);

        Fixture::create([
            'name' => $request->name,
            'description' => $request->description,
            'fixture_category_id' => $request->fixture_category
        ]);

        return back();
    }

    public function edit()
    {
    }

    public function update(Request $request, Fixture $fixture)
    {
        $this->validate([
            'name' => 'required|string',
            'description' => 'required'
        ]);

        $fixture->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return back();
    }

    public function destroy(Fixture $fixture)
    {
        $fixture->delete();

        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use App\Fixture;
use App\FixtureCategory;
use Illuminate\Http\Request;

class FixtureController extends Controller
{
    public function index()
    {
        $this->authorize('can_access_fixtures', User::class);
        $fixturecategories = FixtureCategory::all();
        $fixtures = Fixture::with('category')->get();

        return view('admin.sites.fixtures.index', compact(
            'fixturecategories',
            'fixtures'
        ));
    }

    public function store(Request $request)
    {
        $this->authorize('can_access_fixtures', User::class);
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

    public function edit(Fixture $fixture)
    {
        $this->authorize('can_access_fixtures', User::class);
        $fixturecategories = FixtureCategory::all();

        return view('admin.sites.fixtures.edit', compact(
            'fixturecategories',
            'fixture'
        ));
    }

    public function update(Request $request, Fixture $fixture)
    {
        $this->authorize('can_access_fixtures', User::class);
        $request->validate([
            'name' => 'required|string',
            'description' => 'required',
            'fixture_category' => 'required|exists:fixture_categories,id'
        ]);

        $fixture->update([
            'name' => $request->name,
            'description' => $request->description,
            'fixture_category_id' => $request->fixture_category
        ]);

        return redirect()->route('fixture_index');
    }

    public function destroy(Fixture $fixture)
    {
        $this->authorize('can_access_fixtures', User::class);
        $fixture->delete();

        return back();
    }
}

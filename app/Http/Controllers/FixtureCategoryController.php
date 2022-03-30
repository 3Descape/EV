<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FixtureCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FixtureCategoryController extends Controller
{
    public function index()
    {
        $this->authorize('can_access_fixtures', User::class);
        $fixturecategories = FixtureCategory::all();

        return view('admin.sites.fixture_categories.fixture_categories_index', compact(
            'fixturecategories'
        ));
    }

    public function store(Request $request)
    {
        $this->authorize('can_access_fixtures', User::class);
        $request->validate([
            'name' => 'required|string|unique:fixture_categories,name'
        ]);

        FixtureCategory::create([
            'name' => $request->name
        ]);

        return back();
    }

    public function edit(FixtureCategory $fixturecategory)
    {
        $this->authorize('can_access_fixtures', User::class);

        return view('admin.sites.fixture_categories.fixture_categories_edit', compact(
            'fixturecategory'
        ));
    }

    public function update(Request $request, FixtureCategory $fixturecategory)
    {
        $this->authorize('can_access_fixtures', User::class);
        $request->validate([
            'name' => [
                'required',
                'string',
                Rule::unique('fixture_categories')->ignore($fixturecategory->name, 'name')
            ]
        ]);
        $fixturecategory->update([
            'name' => $request->name
        ]);

        return redirect()->route('fixture_category_index');
    }

    public function destroy(FixtureCategory $fixturecategory)
    {
        $this->authorize('can_access_fixtures', User::class);
        $fixturecategory->delete();

        return back();
    }
}

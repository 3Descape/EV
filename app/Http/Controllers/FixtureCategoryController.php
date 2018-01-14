<?php

namespace App\Http\Controllers;

use App\FixtureCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FixtureCategoryController extends Controller
{
    public function index()
    {
        $fixturecategories = FixtureCategory::all();

        return view('admin.sites.fixture_categories.index', compact(
            'fixturecategories'
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

    public function edit(FixtureCategory $fixturecategory)
    {
        return view('admin.sites.fixture_categories.edit', compact(
            'fixturecategory'
        ));
    }

    public function update(Request $request, FixtureCategory $fixturecategory)
    {
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
        $fixturecategory->delete();

        return back();
    }
}

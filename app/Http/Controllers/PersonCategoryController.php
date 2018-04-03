<?php

namespace App\Http\Controllers;

use App\PersonCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PersonCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $person_categories = PersonCategory::all();

        return view('admin.sites.person_categories.person_category_index', compact(
            'person_categories'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:person_categories,name|string',
            'has_image' => 'required|boolean'
        ]);

        PersonCategory::create([
            'name' => $data['name'],
            'has_image' => $data['has_image']
        ]);

        return redirect()->route('person_category_index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PersonCategory $person_category)
    {
        return view('admin.sites.person_categories.person_category_edit', compact(
            'person_category'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PersonCategory $person_category)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                Rule::unique('people_categories')->ignore($person_category->name, 'name')
            ],
            'has_image' => 'required|boolean'
        ]);

        $person_category->update([
            'name' => $data['name'],
            'has_image' => $data['has_image']
        ]);

        return redirect()->route('person_category_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersonCategory $person_category)
    {
        if ($person_category->people()->get()->count() > 0) {
            return back()->with(['error' => "Dieser Kategorie sind noch Personen zugeordent.
            Bitte ordnen Sie diesen Personen eine Andere Kategorie zu oder löschen Sie diese."]);
        }
        $person_category->delete();

        return back();
    }
}

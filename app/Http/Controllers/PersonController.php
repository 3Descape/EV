<?php

namespace App\Http\Controllers;

use App\User;
use App\Person;
use App\PeopleCategory;
use Illuminate\Http\Request;
use App\Htttp\Helpers\StoreImage;
use Illuminate\Support\Facades\Storage;

class PersonController extends Controller
{
    public function index(PeopleCategory $category)
    {
        $this->authorize('can_access_people', User::class);
        $people = $category->people()->get();

        return view('admin.sites.people.show', [
            'people' => $people,
            'category' => $category
        ]);
    }

    public function add(PeopleCategory $category)
    {
        return view('admin.sites.people.add', [
            'category' => $category
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'nullable',
            'people_category_id' => 'required'
        ]);

        $image = new StoreImage();

        $saved = $image->store($request->file('file'), 'people', false);

        Person::create([
            'name' => $request->name,
            'description' => $request->description,
            'people_category_id' => $request->people_category_id,
            'image_path' => $saved->mainPath
        ]);

        return redirect()->route(
            'admin_people_frontend',
            PeopleCategory::find($request->people_category_id)->name
        );
    }

    public function edit(Person $person)
    {
        return view('admin.sites.people.edit', ['person' => $person]);
    }

    public function update(Person $person, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'nullable',
            'category' => 'required',
        ]);
        if ($person->image_path) {
            Storage::delete('public/' . $person->image_path);
        }

        $image = new StoreImage();
        $saved = $image->store($request->file('file'), 'people/', false);

        $person->update([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'image_path' => $saved->mainPath
        ]);

        return redirect()->route(
            'a_people_frontend',
            $person->category->name
        );
    }

    public function delete(Person $person)
    {
        Person::destroy($person->id);

        return back();
    }
}

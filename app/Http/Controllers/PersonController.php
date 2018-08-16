<?php

namespace App\Http\Controllers;

use App\User;
use App\Image;
use App\Person;
use App\PersonCategory;
use Illuminate\Http\Request;
use App\Http\Helpers\StoreImage;
use Illuminate\Support\Facades\Storage;

class PersonController extends Controller
{
    public function index(PersonCategory $category)
    {
        $this->authorize('can_access_people', User::class);
        $people = $category->people()->orderBy('people.name')->get();

        return view('admin.sites.people.person_index', [
            'people' => $people,
            'category' => $category
        ]);
    }

    public function create(PersonCategory $category)
    {
        $this->authorize('can_access_people', User::class);

        return view('admin.sites.people.person_create', [
            'category' => $category,
            'categories' => PersonCategory::all(),
            'images' => Image::all()
        ]);
    }

    public function edit(Person $person)
    {
        $this->authorize('can_access_people', User::class);
        $person->load('category');
        $categories = PersonCategory::all();
        $images = Image::all();

        return view('admin.sites.people.person_edit', compact(
            'person',
            'categories',
            'images'
        ));
    }

    public function store(Request $request)
    {
        $this->authorize('can_access_people', User::class);
        $this->validate($request, [
            'name' => 'required|string',
            'person_category_id' => 'required|exists:person_categories,id',
            'file' => 'image',
        ]);

        $person = Person::create([
            'name' => $request->name,
            'markup' => $request->markup ?? '',
            'html' => $request->html ?? '',
            'email' => $request->email,
            'person_category_id' => $request->person_category_id
        ]);

        if ($request->hasFile('file')) {
            $image = new StoreImage();
            $saved = $image->store($request->file, 'people/', false);
            $person->update([
                'image_path' => $saved->mainPath
            ]);
        }

        return response()->json(['msg' => 'Person wurde erstellt.', 'person' => $person->load('category')], 200);
    }

    public function update(Person $person, Request $request)
    {
        $this->authorize('can_access_people', User::class);
        $this->validate($request, [
            'name' => 'required|string',
            'person_category_id' => 'required|exists:person_categories,id',
            'file' => 'image',
        ]);

        if ($request->hasFile('file')) {
            if ($person->image_path) {
                Storage::disk('public')->delete($person->image_path);
            }
            $image = new StoreImage();
            $saved = $image->store($request->file, 'people/', false);
            $person->update([
                'image_path' => $saved->mainPath
            ]);
        }

        $person->update([
            'name' => $request->name,
            'markup' => $request->markup ?? '',
            'html' => $request->html ?? '',
            'email' => $request->email,
            'person_category_id' => $request->person_category_id,
        ]);

        return response()->json(['status' => 'Updated person', 'person' => $person->load('category')], 200);
    }

    public function destroy(Person $person)
    {
        $this->authorize('can_access_people', User::class);
        Person::destroy($person->id);

        return back();
    }
}

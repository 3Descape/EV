<?php

namespace App\Http\Controllers;

use App\User;
use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $this->authorize('can_access_events', User::class);
        $categories = Category::all();

        return view('admin.sites.categories.categories_index', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('can_access_events', User::class);
        $this->validate($request, [
            'name' => 'required|max:30|unique:categories,name'
        ]);
        $test = Category::create([
            'name' => $request->name
        ]);

        return back();
    }

    public function edit($id)
    {
        $this->authorize('can_access_events', User::class);
        $category = Category::find($id);

        return view('admin.sites.categories.categories_edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $this->authorize('can_access_events', User::class);
        $this->validate($request, [
            'name' => 'required|max:30|unique:categories,name'
        ]);
        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin_categories');
    }

    public function pre_delete(Category $category)
    {
        $this->authorize('can_access_events', User::class);
        $events = $category->events()->get();
        //only if no event is associated with this category we can redirect
        //to actually delete it
        if ($events->count() == 0) {
            return redirect()->route('admin_categories');
        }
        //othervise we get all other categories and associated events
        //and return a view where the user can change the category for the
        //associated events
        $categories = Category::where('id', '!=', $category->id)->get();

        return view('admin.sites.categories.categories_pre_delete', [
            'events' => $events,
            'categories' => $categories,
            'category' => $category
        ]);
    }

    public function destroy(Category $category)
    {
        $this->authorize('can_access_events', User::class);
        if ($category->events()->count() != 0) {
            return redirect()->route('adming_categories_pre_delete', $category->id);
        }
        $category->delete();

        return back();
    }
}

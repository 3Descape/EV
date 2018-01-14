<?php

namespace App\Http\Controllers;

use App\User;
use App\SiteCategory;
use Illuminate\Http\Request;

class SiteCategoriesController extends Controller
{
    public function index()
    {
        $this->authorize('can_access_events', User::class);
        $categories = SiteCategory::all();

        return view('admin.sites.sites_categories.sites_categories_index', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('can_access_events', User::class);
        $this->validate($request, [
            'name' => 'required|max:30|unique:categories,name'
        ]);
        $test = SiteCategory::create([
            'name' => $request->name
        ]);

        return back();
    }

    public function edit($id)
    {
        $this->authorize('can_access_events', User::class);
        $category = SiteCategory::find($id);

        return view('admin.sites.sites_categories.sites_categories_edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, SiteCategory $category)
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

    public function pre_delete(SiteCategory $category)
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
        $categories = SiteCategory::where('id', '!=', $category->id)->get();

        return view('admin.sites.sites_categories.sites_categories_pre_delete', [
            'events' => $events,
            'categories' => $categories,
            'category' => $category
        ]);
    }

    public function destroy(SiteCategory $category)
    {
        $this->authorize('can_access_events', User::class);
        if ($category->events()->count() != 0) {
            return redirect()->route('adming_categories_pre_delete', $category->id);
        }
        $category->delete();

        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use App\EventCategory;
use Illuminate\Http\Request;

class EventCategoryController extends Controller
{
    public function index()
    {
        $this->authorize('can_access_events', User::class);
        $categories = EventCategory::all();

        return view('admin.sites.event_categories.event_categories_index', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('can_access_events', User::class);
        $this->validate($request, [
            'name' => 'required|max:30|unique:categories,name'
        ]);
        $test = EventCategory::create([
            'name' => $request->name
        ]);

        return back();
    }

    public function edit(EventCategory $event_category)
    {
        $this->authorize('can_access_events', User::class);

        return view('admin.sites.event_categories.event_categories_edit', compact(
            'event_category'
        ));
    }

    public function update(Request $request, EventCategory $event_category)
    {
        $this->authorize('can_access_events', User::class);
        $request->validate([
            'name' => 'required|max:30|unique:categories,name'
        ]);

        $event_category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('event_categories_index');
    }

    public function conflict(EventCategory $event_category)
    {
        $this->authorize('can_access_events', User::class);
        $events = $event_category->events()->get();
        //only if no event is associated with this category we can redirect
        //to actually delete it
        if ($events->count() == 0) {
            return redirect()->route('event_category_index');
        }
        //othervise we get all other categories and associated events
        //and return a view where the user can change the category for the
        //associated events
        $categories = EventCategory::where('id', '!=', $event_category->id)->get();

        return view('admin.sites.event_categories.event_categories_pre_delete', compact(
            'events',
            'categories',
            'event_category'
        ));
    }

    public function destroy(EventCategory $event_category)
    {
        $this->authorize('can_access_events', User::class);
        if ($event_category->events()->count() != 0) {
            return redirect()->route('event_category_conflict', $event_category->id);
        }
        $event_category->delete();

        return back();
    }
}

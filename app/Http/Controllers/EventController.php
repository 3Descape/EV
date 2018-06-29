<?php

namespace App\Http\Controllers;

use App\User;
use App\Event;
use App\Image;
use Carbon\Carbon;
use App\EventCategory;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function events_future()
    {
        $this->authorize('can_access_events', User::class);
        $events = Event::with('category')->futureEvents()->get();

        return view('admin.sites.events.events', [
            'events' => $events,
            'categories' => EventCategory::all(),
        ]);
    }

    public function events_archived()
    {
        $this->authorize('can_access_events', User::class);

        return view('admin.sites.events.events_archived', [
            'events' => Event::pastEvents()->paginate(20),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('can_access_events', User::class);
        $this->validate($request, [
            'name' => 'required|max:255',
            'markup' => 'required',
            'date' => 'required|date_format:d.m.Y H:i',
            'location' => 'required|min:5',
            'event_category_id' => 'exists:event_categories,id',
        ]);

        $date = Carbon::createFromFormat('d.m.Y H:i', $request->date);

        Event::create([
            'name' => $request->name,
            'html' => $request->markup,
            'markup' => $request->markup,
            'date' => $date,
            'location' => $request->location,
            'event_category_id' => $request->event_category_id,
        ]);

        return back();
    }

    public function edit($id)
    {
        $this->authorize('can_access_events', User::class);
        $event = Event::with('images', 'category')->find($id);

        return view('admin.sites.events.event_edit', [
            'event' => $event,
            'categories' => EventCategory::all(),
            'images' => Image::all()
        ]);
    }

    public function resolve_conflict(Request $request, Event $event)
    {
        $this->authorize('can_access_events', User::class);
        $event->update([
            'event_category_id' => $request->event_category_id
        ]);

        return back();
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|max:255',
            'location' => 'required',
            'date' => 'required|date_format:"d.m.Y H:i"',
            'event_category_id' => 'required|exists:event_categories,id',
        ], [
            'date_format' => 'Datum entspricht nicht dem gültigen Format für dd.MM.yyyy HH:mm'
        ]);

        $date = Carbon::createFromFormat('d.m.Y H:i', $request->date);

        $event->update([
            'name' => $request->name,
            'event_category_id' => $request->event_category_id,
            'markup' => $request->markup,
            'html' => $request->html,
            'date' => $date,
            'location' => $request->location
        ]);

        if (request()->expectsJson()) {
            return response()->json([
                'status' => 'Veranstaltung wurde aktualisiert.'
            ], 200);
        }

        return back();
    }

    public function destroy(Event $event)
    {
        $this->authorize('can_access_events', User::class);
        $event->delete();

        return back();
    }
}

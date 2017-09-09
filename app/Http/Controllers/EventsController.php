<?php

namespace App\Http\Controllers;

use App\User;
use App\Event;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventsController extends Controller
{

    public function events_future()
    {
        $this->authorize('can_access_events', User::class);
        $events = Event::with('category')->futureEvents()->get();
        return view('admin.sites.events.events',[
            'events' => $events,
            'categories' => Category::all(),
        ]);
    }

    public function events_archived()
    {
        $this->authorize('can_access_events', User::class);
        return view('admin.sites.events.events_archived',[
            'events' => Event::pastEvents()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('can_access_events', User::class);
        $this->validate($request,[
            'name' => 'required|min:5|max:255',
            'description' => 'required|min:5',
            'date' => 'required|date_format:d.m.Y H:i',
            'location' => 'required|min:5',
            'category_id' => 'exists:categories,id',
        ]);

        $date = Carbon::createFromFormat('d.m.Y H:i', $request->date);

        Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'date' => $date,
            'location' => $request->location,
            'category_id' => intval($request->category),
        ]);

        return back();
    }

    public function edit($id)
    {
        $this->authorize('can_access_events', User::class);
        $event = Event::with('images', 'category')->find($id);

        return view('admin.sites.events.event_edit',[
            'event' => $event,
            'categories' => Category::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('can_access_events', User::class);
        if(request('type') && request('type') == 'conflict')
        {
            Event::find($id)->update([
                'category_id' => $request->category
            ]);
            return back();
        }

        if($request->has('date')){
            $this->validate($request,[
                'name' => 'required|min:5|max:255',
                'description' => 'required|min:10',
                'location' => 'required|min:5',
                'date' => 'required|date_format:d.m.Y H:i',
                'category_id' => 'exists:categories,id',
            ],[
                'date_format' => 'Datum entspricht nicht dem gültigen Format für dd.MM.yyyy HH:mm'
            ]);

            $date = Carbon::createFromFormat('d.m.Y H:i', $request->date);

            Event::find($id)->update([
                'name' => $request->name,
                'category_id' => $request->category,
                'description' => $request->description,
                'date' => $date,
                'location' => $request->location
            ]);
        }else
        {
            $this->validate($request,[
                'name' => 'required|min:5|max:255',
                'description' => 'required|min:10',
                'location' => 'required|min:5',
                'category_id' => 'exists:categories,id',
            ]);

            Event::find($id)->update([
                'name' => $request->name,
                'category_id' => $request->category,
                'description' => $request->description,
                'location' => $request->location
            ]);
        }

        if(request('redirect') == 'archived'){
            return redirect()->route('admin_events_archived');
        }
        return redirect()->route('admin_events_future');
    }

    public function destroy($id)
    {
        $this->authorize('can_access_events', User::class);
        Event::find($id)->delete();
        return back();
    }
}

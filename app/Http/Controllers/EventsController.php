<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Category;
use Carbon\Carbon;
use App\User;

class EventsController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function events_future()
    {
        $this->authorize('can_access_events', User::class);
        $events = Event::with('category')->futureEvents()->get();
        $categories = Category::all();
        return view('admin.sites.events',
        [
            'events' => $events,
            'categories' => $categories
        ]);
    }

    public function events_archived()
    {
        $this->authorize('can_access_events', User::class);
        $events = Event::pastEvents()->get();
        return view('admin.sites.events_archived',[
            'events' => $events,
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('can_access_events', User::class);
        $this->validate($request,[
            'name' => 'required|min:5|max:255',
            'description' => 'required|min:10',
            'date' => 'required|date',
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

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $this->authorize('can_access_events', User::class);
        $categories = Category::all();
        $event = Event::with('images', 'category')->find($id);

        //dd($event);
        return view('admin.sites.event_edit',[
            'event' => $event,
            'categories' => $categories,
        ]);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
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

        //dd($request->date);

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
        }else{
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

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $this->authorize('can_access_events', User::class);
        Event::find($id)->delete();
        return back();
    }
}

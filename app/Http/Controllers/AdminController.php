<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;

class AdminController extends Controller
{
  public function index()
  {
    return view('admin.sites.home');
  }
  public function about()
  {
    return view('admin.sites.about');
  }
  public function events()
  {
    return view('admin.sites.events')->with('events',Event::all()->toJson());
  }
  public function events_json()
  {
    return response()->json(Event::all());
  }

  public function events_store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required|min:5|max:255',
      'date' => 'required|date',
      'text' => 'required|max:255',
    ]);

    Event::create($request->all());
    return back();
  }
  public function event_delete($id){
    Event::where('id','=', $id)->delete();
  }
  public function sga()
  {
    return view('admin.sites.sga');
  }
  public function info()
  {
    return view('admin.sites.info');
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Menu;

class AdminController extends Controller
{
  public function index()
  {
    return view('admin.sites.home');
  }
  public function about()
  {
    $block = Menu::find(1);
    return view('admin.sites.about',['block' => $block]);
  }
  public function text_edit($id){
    $block = Text::find($id);
    return view('admin.sites.text_edit',['block' => $block]);
  }
  public function text_update($id, Request $request){
    $menu=Menu::find($id);
    $menu->name = $request->title;
    $menu->content = $request->text;
    $menu->save();
    return redirect()->route('admin_about');
  }
  public function text_delete($id){
    Text::find($id)->delete();
    return back();
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

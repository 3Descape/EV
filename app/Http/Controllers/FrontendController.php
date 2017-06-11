<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Text;
use App\Event;
use App\Person;
use Carbon\Carbon;
class FrontendController extends Controller
{
  // public function dynamic($route){
  //   $menu=Menu::where('route', $route)->first();
  //   return view('sites.'. $menu->template,['content' => $menu->content]);
  // }
  public function index()
  {
    return view('sites.home');
  }
  public function about()
  {
    $blocks = Text::where('category', '0')->get();
    return view('sites.about',['blocks' => $blocks]);
  }
  public function events()
  {
      $events_future = Event::where('date', '>', Carbon::now())->orderBy('date', 'desc')->get();
      return view('sites.events', ['events' => $events_future]);
  }

  public function events_archive()
  {
      $events_past = Event::where('date', '<', Carbon::now())->orderBy('date', 'desc')->get();
      return view('sites.events_archive', ['events' => $events_past]);
  }
  public function get_people($id)
  {
      $people = Person::where('category', $id)->get();
      return response()->json($people, 200);
  }
  public function sga()
  {
    return view('sites.sga');
  }
  public function info()
  {
    return view('sites.info');
  }
  public function contact()
  {
    return view('sites.contact');
  }
  public function imprint()
  {
    return view('sites.imprint');
  }
}

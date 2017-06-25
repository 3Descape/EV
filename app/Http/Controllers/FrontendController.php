<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $future_events = Event::futureEvents()->take(3)->get();
        $past_events = Event::pastEvents()->take(3)->get();
        return view('sites.home',['future_events' => $future_events, 'past_events' => $past_events]);
    }
    public function download_pdf()
    {
        return response()->download('pdf/file.txt');
    }
    public function about()
    {
        //$people = Person::ElternVertreter()->get();
        return view('sites.about'
        //,['people' => $people]
    );
    }
    public function events_future()
    {
        $events_future = Event::futureEvents()->get();
        return view('sites.events', ['events' => $events_future]);
    }

    public function events_archived()
    {
        $events_past = Event::pastEvents()->get();
        return view('sites.events_archive', ['events' => $events_past]);
    }
    public function sga()
    {
        $people = Person::SGAMitglieder()->get();
        return view('sites.sga',['people' => $people]);
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

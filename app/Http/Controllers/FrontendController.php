<?php

namespace App\Http\Controllers;

use App\Site;
use App\Event;
use App\Image;
use App\EventCategory;
use App\PeopleCategory;
use App\FixtureCategory;
use App\Traits\AnalythicTrait;
use App\SiteCategory;

class FrontendController extends Controller
{
    use AnalythicTrait;

    public function index()
    {
        $this->add_analythic();
        $future_events = Event::futureEvents()->take(3)->get();
        $past_events = Event::pastEvents()->take(3)->get();

        return view('sites.home', [
            'future_events' => $future_events,
            'past_events' => $past_events
        ]);
    }

    public function about()
    {
        $this->add_analythic();
        $committe = PeopleCategory::where('name', 'vorstand')->first()->people()->orderBy('name')->get();
        $sites = SiteCategory::where('url', 'über_uns')->first()->sites()->get();
        $gruppenbild = Image::where('name', 'gruppenbild')->first();

        return view('sites.about', compact(
            'gruppenbild',
            'committe',
            'sites'
        ));
    }

    public function events_future($type = null)
    {
        $this->add_analythic();
        $text = 'Alle';
        if ($type) {
            $text = ucfirst($type);
            $events = EventCategory::where('name', $type)
            ->first()
            ->events()
            ->futureEvents()
            ->paginate(10);
        } else {
            $events = Event::futureEvents()->paginate(10);
        }

        return view('sites.events', [
            'events' => $events,
            'text' => $text,
            'categories' => EventCategory::all(),
        ]);
    }

    public function events_archived($type = null)
    {
        $this->add_analythic();
        if (request('event')) {
            $event = Event::with('images')->find(request('event'));

            return view('sites.event_view', [
                'event' => $event,
            ]);
        } else {
            $text = 'Alle';
            if ($type) {
                $text = ucfirst($type);
                $events = EventCategory::where('name', $type)
                ->first()
                ->events()
                ->with('images')
                ->pastEvents()
                ->paginate(10);
            } else {
                $events = Event::with('images')->pastEvents()->paginate(10);
            }

            return view('sites.events_archive', [
                'events' => $events,
                'text' => $text,
                'categories' => EventCategory::all()
            ]);
        }
    }

    public function sga()
    {
        $this->add_analythic();
        $sites = SiteCategory::where('url', 'sga')->first()->sites()->get();
        $people = PeopleCategory::where('name', 'sga')->first()->people()->get();

        return view('sites.sga', compact(
            'sites',
            'people'
        ));
    }

    public function info()
    {
        $this->add_analythic();
        $sites = SiteCategory::where('url', 'info')->first()->sites()->get();
        $fixturecategories = FixtureCategory::with('fixtures')->get();

        return view('sites.info', compact(
            'sites',
            'fixturecategories'
        ));
    }

    public function contact()
    {
        $this->add_analythic();

        return view('sites.contact');
    }

    public function imprint()
    {
        $this->add_analythic();
        $sites = SiteCategory::where('url', 'impressum')->first()->sites()->get();

        return view('sites.imprint', compact(
            'sites'
        ));
    }
}

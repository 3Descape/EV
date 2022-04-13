<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Image;
use App\Models\EventCategory;
use App\Models\FixtureCategory;
use App\Traits\AnalyticTrait;
use App\Models\SiteCategory;

class FrontendController extends Controller
{
    use AnalyticTrait;

    public function index()
    {
        $this->add_analytic();
        $future_events = Event::futureEvents()->take(3)->get();
        $past_events = Event::pastEvents()->take(3)->get();

        return view('sites.home', [
            'future_events' => $future_events,
            'past_events' => $past_events
        ]);
    }

    public function about()
    {
        $this->add_analytic();
        $sites = SiteCategory::where('url', 'über_uns')->first()->sites()->orderBy('order')->get();
        $gruppenbild = Image::where('name', 'gruppenbild')->first();

        return view('sites.about', compact(
            'gruppenbild',
            'sites'
        ));
    }

    public function events_future($type = null)
    {
        $this->add_analytic();
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
        $this->add_analytic();
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
        $this->add_analytic();
        $sites = SiteCategory::where('url', 'sga')->first()->sites()->orderBy('order')->get();

        return view('sites.sga', compact(
            'sites'
        ));
    }

    public function info()
    {
        $this->add_analytic();
        $sites = SiteCategory::where('url', 'info')->first()->sites()->orderBy('order')->get();
        $fixturecategories = FixtureCategory::with('fixtures')->get();

        return view('sites.info', compact(
            'sites',
            'fixturecategories'
        ));
    }

    public function contact()
    {
        $this->add_analytic();

        return view('sites.contact');
    }

    public function imprint()
    {
        $this->add_analytic();
        $sites = SiteCategory::where('url', 'impressum')->first()->sites()->orderBy('order')->get();

        return view('sites.imprint', compact(
            'sites'
        ));
    }
}

<?php

namespace App\Http\Controllers;
use App\Text;
use App\Event;
use App\Person;
use App\Category;
use App\Traits\AnalythicTrait;
use App\Holiday;

class FrontendController extends Controller
{
    use AnalythicTrait;
    public function index()
    {
        $this->add_analythic();
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
        $this->add_analythic();
        $texts = Text::where('category', 1)->orderBy('order')->get();
        return view('sites.about', [
            'texts' => $texts
        ]);
    }

    public function events_future($type = null)
    {
        $this->add_analythic();
        $text = 'Alle';
        if($type)
        {
            $text = ucfirst($type);
            $events = Category::where('name', $type)
            ->first()
            ->events()
            ->futureEvents()
            ->paginate(10);
        }
        else
        {
            $events = Event::futureEvents()->paginate(10);
        }

        $categories = Category::all();

        return view('sites.events', [
            'events' => $events,
            'text' => $text,
            'categories' => $categories
        ]);
    }

    public function events_archived($type = null)
    {
        $this->add_analythic();
        if(request('event'))
        {
            $event = Event::with('images')->find(request('event'));
            return view('sites.event_view', [
                'event' => $event,
            ]);

        }
        else {
            $text = 'Alle';
            if($type)
            {
                $text = str_lower($type);
                $events = Category::where('name', $type)
                ->first()
                ->events()
                ->with('images')
                ->pastEvents()
                ->paginate(10);
            }
            else
            {
                $events = Event::with('images')->pastEvents()->paginate(10);
            }

            $categories = Category::all();

            return view('sites.events_archive', [
                'events' => $events,
                'text' => $text,
                'categories' => $categories
            ]);
        }
    }

    public function sga()
    {
        $this->add_analythic();
        $people = Person::SGAMitglieder()->get();
        $texts = Text::where('category', 2)->orderBy('order')->get();

        return view('sites.sga',[
            'people' => $people,
            'texts' => $texts
        ]);
    }

    public function info()
    {
        $this->add_analythic();
        $schulfrei = Holiday::where('category', 'ferien')->get();
        $autonom = Holiday::where('category', 'schulautonom')->get();
        $texts = Text::where('category', 3)->orderBy('order')->get();
        return view('sites.info', [
            'texts' => $texts,
            'schulfrei' => $schulfrei,
            'autonom' => $autonom
        ]);
    }

    public function contact()
    {
        $this->add_analythic();
        return view('sites.contact');
    }

    public function imprint()
    {
        $this->add_analythic();
        $text = Text::where('category', 4)->orderBy('order')->first();
        return view('sites.imprint', [
            'text' => $text
        ]);
    }
}

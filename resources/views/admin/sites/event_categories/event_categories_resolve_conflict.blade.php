@extends('admin.layouts.sitebar')

@section('sitebar_inner')
    <div class="col-lg-10 col-md-12 mx-auto">

        <h2 class="text-center">
            Konflikte beim Löschen der Kategorie "{{$event_category->name}}"
        </h2>
        <p>Bitte ordnen Sie die Veranstaltungen einer neuen Kategorie zu!</p>

    <event-resolve-conflict-list :events-prop="{{$events}}" :categories="{{$categories}}"></event-resolve-conlict-list>
    </div>
@endsection

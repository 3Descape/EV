@extends('admin.master')

@section('content')
    <div class="sitebar-wrp">
        <a href="#sidebar" class="data-toggle" data-target="#sidebar" data-toggle="collapse" aria-expanded="true" aria-controls="sidebar">
            <i class="fa fa-navicon fa-2x py-2 p-1"></i>
        </a>

        <div class="px-0 collapse width show" id="sidebar">
            <div class="list-group border-0 card text-center text-md-left">

                <div class="list-group-item d-inline-block user">
                    <i class="fa fa-user"></i>
                    <span class="d-none d-md-inline-block">{{Auth::user()->name}}</span>
                </div>

                @can('can_access_dashboard', \App\User::class)
                    <a href="{{route('admin_dashboard')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
                        <i class="fa fa-tachometer"></i>
                        <span class="d-none d-md-inline-block">Dashboard</span>
                    </a>
                @endcan

                @can('can_access_events', \App\User::class)
                    <a href="#events" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
                        <i class="fa fa-calendar"></i>
                        <span class="d-none d-md-inline-block">Veranstaltungen</span>
                    </a>

                    <div class="collapse" id="events">
                        <a href="{{route('admin_events_future')}}" class="list-group-item">
                            <i class="fa fa-clock-o"></i>
                            <span class="d-none d-md-inline-block">Zukünftig</span>
                        </a>

                        <a href="{{route('admin_events_archived')}}" class="list-group-item">
                            <i class="fa fa-archive"></i>
                            <span class="d-none d-md-inline-block">Archiv</span>
                        </a>

                        <a href="{{route('admin_categories')}}" class="list-group-item">
                            <i class="fa fa-filter"></i>
                            <span class="d-none d-md-inline-block">Kategorien</span>
                        </a>
                    </div>
                @endcan

                @can('can_access_sites', \App\User::class)
                    <a href="#sites" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
                        <i class="fa fa-sitemap"></i>
                        <span class="d-none d-md-inline-block">Seiten</span>
                    </a>

                    <div class="collapse" id="sites">
                        <a href="{{route('admin_about')}}" class="list-group-item">
                            Über uns
                        </a>

                        <a href="{{route('admin_sga')}}" class="list-group-item">
                            SGA
                        </a>

                        <a href="{{route('admin_info')}}" class="list-group-item">
                            Info
                        </a>

                        <a href="{{route('admin_imprint')}}" class="list-group-item">
                            Impressum
                        </a>
                    </div>
                @endcan

                {{--  @can('', \App\User::class)  --}}
                    <a href="#fixture" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
                        <i class="fa fa-clock-o"></i>
                        <span class="d-none d-md-inline-block">Thermine</span>
                    </a>

                    <div class="collapse" id="fixture">
                        <a href="{{route('fixture_index')}}" class="list-group-item">
                            <i class="fa fa-clock-o"></i>
                            <span class="d-none d-md-inline-block">Thermine</span>
                        </a>

                        <a href="{{route('fixture_category_index')}}" class="list-group-item">
                            <i class="fa fa-filter"></i>
                            <span class="d-none d-md-inline-block">Kategorien</span>
                        </a>
                    </div>
                {{--  @endcan  --}}

                @can('can_access_people', \App\User::class)
                    <a href="#personen" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
                        <i class="fa fa-users"></i>
                        <span class="d-none d-md-inline-block">Personen</span>
                    </a>

                    <div class="collapse" id="personen">
                        <a href="#frontend" class="list-group-item" data-toggle="collapse" aria-expanded="false">
                            <i class="fa fa-eye"></i>
                            <span class="d-none d-md-inline-block">Frontend</span>
                        </a>

                        <div class="collapse" id="frontend">
                            <a href="{{route('a_people_frontend', 'sga')}}" class="list-group-item" data-parent="#frontend">SGA</a>
                            <a href="{{route('a_people_frontend', 'ev')}}" class="list-group-item" data-parent="#frontend">Elternvertreter</a>
                            <a href="{{route('a_people_frontend', 'vorstand')}}" class="list-group-item" data-parent="#frontend">Vorstände</a>
                        </div>

                        <a href="{{route('admin_people_backend')}}" class="list-group-item">
                            <i class="fa fa-eye-slash"></i>
                            <span class="d-none d-md-inline-block">Backend</span>
                        </a>
                    </div>
                @endcan

                @can ('can_access_files', \App\User::class)
                    <a href="{{route('files')}}" class="list-group-item d-inline-block" data-parent="#sidebar">
                        <i class="fa fa-download"></i>
                        <span class="d-none d-md-inline-block">Downloads</span>
                    </a>
                @endcan

                @can ('can_access_pictures', \App\User::class)
                    <a href="{{route('pictures')}}" class="list-group-item d-inline-block" data-parent="#sidebar">
                        <i class="fa fa-picture-o"></i>
                        <span class="d-none d-md-inline-block">Bilder</span>
                    </a>
                @endcan

                @can('can_access_roles', \App\User::class)
                    <a href="{{route('roles_show')}}" class="list-group-item d-inline-block" data-parent="#sidebar">
                        <i class="fa fa-globe"></i>
                        <span class="d-none d-md-inline-block">Berechtigungen</span>
                    </a>
                @endcan
                <form action="{{route('logout')}}" method="POST">
                    <button type="submit" class="list-group-item d-inline-block">
                        <i class="fa fa-sign-out"></i>
                        <span class="d-none d-md-inline-block">Logout</span>
                    </button>
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>

    <div class="content">
        @yield('sitebar_inner')
    </div>
@endsection

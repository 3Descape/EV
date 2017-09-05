@extends('admin.master')

@section('content')

    <div class="sitebar-wrp">
        <a href="#" class="data-toggle" data-target="#sidebar" data-toggle="collapse"><i class="fa fa-navicon fa-2x py-2 p-1"></i></a>

        <div class="px-0 collapse fade width show" id="sidebar">

            <div class="list-group border-0 card text-center text-md-left">

                <div class="list-group-item d-inline-block user">
                    <i class="fa fa-user"></i>
                    <span class="hidden-sm-down">{{Auth::user()->name}}</span>
                </div>

                @can('can_access_dashboard', \App\User::class)
                    <a href="{{route('admin_dashboard')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-tachometer"><span class="hidden-sm-down">Dashboard</span></i>
                    </a>
                @endcan

                @can('can_access_people', \App\User::class)
                    <a href="#personen" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fa fa-users"><span class="hidden-sm-down">Personen</span></i>
                    </a>
                    <div class="collapse" id="personen">
                        <a href="#frontend" class="list-group-item" data-toggle="collapse" aria-expanded="false">
                            <i class="fa fa-eye"><span class="hidden-sm-down">Frontend</span></i>
                        </a>
                        <div class="collapse" id="frontend">
                            <a href="{{route('admin_people_frontend_sga')}}" class="list-group-item" data-parent="#frontend">SGA</a>
                            <a href="{{route('admin_people_frontend_ev')}}" class="list-group-item" data-parent="#frontend">Elternvertreter</a>
                        </div>

                        <a href="{{route('admin_people_backend')}}" class="list-group-item">
                            <i class="fa fa-eye"><span class="hidden-sm-down">Backend</span></i>
                        </a>
                    </div>
                @endcan


                @can('can_access_sites', \App\User::class)
                    <a href="#sites" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fa fa-sitemap"><span class="hidden-sm-down">Seiten</span></i>
                    </a>

                    <div class="collapse" id="sites">
                        <a href="{{route('admin_about')}}" class="list-group-item">
                            <i class="fa fa-eye"><span class="hidden-sm-down">Über uns</span></i>
                        </a>
                        <a href="{{route('admin_sga')}}" class="list-group-item">
                            <i class="fa fa-eye"><span class="hidden-sm-down">SGA</span></i>
                        </a>
                        <a href="{{route('admin_info')}}" class="list-group-item">
                            <i class="fa fa-eye"><span class="hidden-sm-down">Info</span></i>
                        </a>
                        <a href="{{route('admin_imprint')}}" class="list-group-item">
                            <i class="fa fa-eye"><span class="hidden-sm-down">Impressum</span></i>
                        </a>
                    </div>
                @endcan


                @can('can_access_roles', \App\User::class)
                    <a href="{{route('roles_show')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
                        <i class="fa fa-globe"><span class="hidden-sm-down">Berechtigungen</span></i>
                    </a>
                @endcan


                @can('can_access_events', \App\User::class)
                    <a href="#events" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fa fa-calendar"><span class="hidden-sm-down">Veranstaltungen</span></i></a>

                    <div class="collapse" id="events">
                        <a href="{{route('admin_events_future')}}" class="list-group-item">
                            <i class="fa fa-clock-o"><span class="hidden-sm-down">Zukünftig</span></i>
                        </a>

                        <a href="{{route('admin_events_archived')}}" class="list-group-item">
                            <i class="fa fa-archive"><span class="hidden-sm-down">Archiv</span></i>
                        </a>

                        <a href="{{route('admin_categories')}}" class="list-group-item">
                            <i class="fa fa-filter"><span class="hidden-sm-down">Kategorien</span></i>
                        </a>
                    </div>
                @endcan

                @can('can_access_holiday', \App\User::class)
                    <a href="{{route('holiday_index')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
                        <i class="fa fa-refresh"><span class="hidden-sm-down">Ferien</span></i>
                    </a>
                @endcan

                <form action="{{route('logout')}}" method="POST">
                    <button type="submit" class="list-group-item d-inline-block">
                        <i class="fa fa-sign-out"><span class="hidden-sm-down">Logout</span></i>
                    </button>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
    </div>


    <div class="content">
        @yield('sitebar_inner')
    </div>
@endsection

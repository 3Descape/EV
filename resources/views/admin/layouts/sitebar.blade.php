@extends('admin.master')

@section('content')
    <div class="sitebar-wrp">
        <a href="#sidebar" class="data-toggle" data-bs-toggle="collapse" aria-expanded="true" aria-controls="sidebar">
            <i class="fas fa-bars fa-2x py-2 p-1"></i>
        </a>

        <div class="px-0 collapse width show" id="sidebar">
            <div class="list-group border-0 card text-center text-md-start">

                <div class="list-group-item d-inline-block user">
                    <i class="fas fa-user-circle"></i>
                    <span class="d-none d-md-inline-block">{{Auth::user()->name}}</span>
                </div>

                @can('can_access_dashboard', \App\Models\User::class)
                    <a href="{{route('dashboard')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
                        <i class="fas fa-chart-line me-md-1"></i>
                        <span class="d-none d-md-inline-block">Dashboard</span>
                    </a>
                @endcan

                @can('can_access_events', \App\Models\User::class)
                    <a href="#events" class="list-group-item d-inline-block collapsed" data-bs-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
                        <i class="fas fa-calendar-alt me-md-1"></i>
                        <span class="d-none d-md-inline-block">Veranstaltungen</span>
                    </a>

                    <div class="collapse" id="events">
                        <a href="{{route('event_future_index')}}" class="list-group-item">
                            <i class="fas fa-clock me-md-1"></i>
                            <span class="d-none d-md-inline-block"> Zukünftig</span>
                        </a>

                        <a href="{{route('event_archived_index')}}" class="list-group-item">
                            <i class="fa fa-archive me-md-1"></i>
                            <span class="d-none d-md-inline-block"> Archiv</span>
                        </a>

                        <a href="{{route('event_category_index')}}" class="list-group-item">
                            <i class="fa fa-filter me-md-1"></i>
                            <span class="d-none d-md-inline-block"> Kategorien</span>
                        </a>
                    </div>
                @endcan

                @can('can_access_sites', \App\Models\User::class)
                    <a href="#sites" class="list-group-item d-inline-block collapsed" data-bs-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
                        <i class="fa fa-sitemap me-md-1"></i>
                        <span class="d-none d-md-inline-block">Seiten</span>
                    </a>

                    <div class="collapse" id="sites">
                        @foreach ($site_categories as $site_category)
                            <a href="{{route('site_edit', $site_category->url)}}" class="list-group-item">
                                {{ $site_category->name }}
                            </a>
                        @endforeach
                    </div>
                @endcan

                @can ('can_access_pictures', \App\Models\User::class)
                    <a href="{{route('image_index')}}" class="list-group-item d-inline-block" data-parent="#sidebar">
                        <i class="fas fa-images me-md-1"></i>
                        <span class="d-none d-md-inline-block">Bilder</span>
                    </a>
                @endcan

                @can ('can_access_files', \App\Models\User::class)
                    <a href="{{route('file_index')}}" class="list-group-item d-inline-block" data-parent="#sidebar">
                        <i class="fa fa-download me-md-1"></i>
                        <span class="d-none d-md-inline-block">Downloads</span>
                    </a>
                @endcan

                {{-- @can('can_access_fixtures', \App\Models\User::class)
                    <a href="#fixture" class="list-group-item d-inline-block collapsed" data-bs-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
                        <i class="fas fa-info-circle me-md-1"></i>
                        <span class="d-none d-md-inline-block">Termine</span>
                    </a>

                    <div class="collapse" id="fixture">
                        <a href="{{route('fixture_index')}}" class="list-group-item">
                            <i class="fas fa-calendar-alt me-md-1"></i>
                            <span class="d-none d-md-inline-block">Termine</span>
                        </a>

                        <a href="{{route('fixture_category_index')}}" class="list-group-item">
                            <i class="fa fa-filter me-md-1"></i>
                            <span class="d-none d-md-inline-block">Kategorien</span>
                        </a>
                    </div>
                @endcan --}}

                @can('can_access_people', \App\Models\User::class)
                    <a href="#personen" class="list-group-item d-inline-block collapsed" data-bs-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
                        <i class="fa fa-users me-md-1"></i>
                        <span class="d-none d-md-inline-block">Personen</span>
                    </a>

                    <div class="collapse" id="personen">
                        @foreach($person_categories as $category)
                            <a href="{{route('person_index', $category->name)}}" class="list-group-item" data-parent="#personen">
                                {{ucfirst($category->name)}}
                            </a>
                        @endforeach
                        <a href="{{route('person_category_index')}}" class="list-group-item" data-parent="#frontend">Kategorien</a>
                    </div>
                @endcan

                @can('can_access_user', \App\Models\User::class)

                    <a href="{{route('user_index')}}" class="list-group-item d-inline-block" data-parent="#sidebar">
                        <i class="fas fa-user-circle me-md-1"></i>
                        <span class="d-none d-md-inline-block">Nutzer</span>
                    </a>
                @endcan

                @can('can_access_user', \App\Models\User::class)
                    <a href="{{route('role_index')}}" class="list-group-item d-inline-block" data-parent="#sidebar">
                        <i class="fas fa-globe me-md-1"></i>
                        <span class="d-none d-md-inline-block">Berechtigungen</span>
                    </a>
                @endcan
                <form action="{{route('logout')}}" method="POST">
                    <button type="submit" class="list-group-item d-inline-block">
                        <i class="fas fa-sign-out-alt ms-1 me-md-1"></i>
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

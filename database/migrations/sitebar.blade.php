@extends('admin.master')

@section('content')

    <div class="d-flex">
        <div class="sitebar-wrp">
            <a href="#" class="data-toggle" data-target="#sidebar" data-toggle="collapse"><i class="fa fa-navicon fa-2x py-2 p-1"></i></a>

            <div class="px-0 collapse fade width show" id="sidebar">

                <div class="list-group border-0 card text-center text-md-left">

                    <div class="list-group-item user">
                        <i class="fa fa-user"></i>{{Auth::user()->name}}
                    </div>

                    <a href="{{route('admin_dashboard')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-tachometer"></i> <span class="hidden-sm-down">Dashboard</span></a>

                    <a href="#personen" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fa fa-users"></i> <span class="hidden-sm-down">Personen</span></a>

                    <div class="collapse" id="personen">
                        <a href="{{route('admin_people_frontend')}}" data-parent="personen" class="list-group-item">
                            <i class="fa fa-eye"></i>
                            Frontend
                        </a>

                        <a href="{{route('admin_people_backend')}}" data-parent="personen" class="list-group-item">
                            <i class="fa fa-eye-slash"></i>
                            <span class="hidden-sm-down">Backend</span>
                        </a>
                    </div>


                    <a href="#menu1" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fa fa-dashboard"></i> <span class="hidden-sm-down">Item 1</span></a>

                    <div class="collapse" id="menu1">
                        <a href="#menu1sub1" class="list-group-item" data-toggle="collapse" aria-expanded="false">Subitem 1 </a>
                        <div class="collapse" id="menu1sub1">
                            <a href="#" class="list-group-item" data-parent="#menu1sub1">Subitem 1 a</a>
                            <a href="#" class="list-group-item" data-parent="#menu1sub1">Subitem 2 b</a>
                            <a href="#menu1sub1sub1" class="list-group-item" data-toggle="collapse" aria-expanded="false">Subitem 3 c </a>
                            <div class="collapse" id="menu1sub1sub1">
                                <a href="#" class="list-group-item" data-parent="#menu1sub1sub1">Subitem 3 c.1</a>
                                <a href="#" class="list-group-item" data-parent="#menu1sub1sub1">Subitem 3 c.2</a>
                            </div>
                            <a href="#" class="list-group-item" data-parent="#menu1sub1">Subitem 4 d</a>
                            <a href="#menu1sub1sub2" class="list-group-item" data-toggle="collapse" aria-expanded="false">Subitem 5 e </a>
                            <div class="collapse" id="menu1sub1sub2">
                                <a href="#" class="list-group-item" data-parent="#menu1sub1sub2">Subitem 5 e.1</a>
                                <a href="#" class="list-group-item" data-parent="#menu1sub1sub2">Subitem 5 e.2</a>
                            </div>
                        </div>
                        <a href="#" class="list-group-item" data-parent="#menu1">Subitem 2</a>
                        <a href="#" class="list-group-item" data-parent="#menu1">Subitem 3</a>
                    </div>

                    <form action="{{route('logout')}}" method="POST">
                        <button type="submit" class="list-group-item"><i class="fa fa-sign-out"></i>Logout</button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>
        </div>


        <div class="" style="flex:1">
            @yield('sitebar_inner')
        </div>
    </div>

@endsection

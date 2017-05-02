<nav class="navbar fixed-top navbar-toggleable-md navbar-inverse " id="menu">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="{{ route('home') }}">Ev Weiz</a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto">
      {{-- @foreach ($links as $link)
        <li class="nav-item" >
          <a class="nav-link" href="{{route('home').'/'. $link->route}}">{{$link->name}} <span class="sr-only">(current)</span></a>
        </li>
      @endforeach --}}

    </ul>
  </div>
</nav>

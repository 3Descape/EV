<nav class="navbar navbar-toggleable-md navbar-inverse">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="{{ route('home') }}">Ev Weiz</a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto">
        <li class="nav-item" >
          <a class="nav-link" href="{{route('about')}}">Über uns</a>
        </li>

        <li class="nav-item" >
          <a class="nav-link" href="{{route('events')}}">Veranstaltungen</a>
        </li>
        <li class="nav-item" >
          <a class="nav-link" href="{{route('sga')}}">SGA</a>
        </li>
        <li class="nav-item" >
          <a class="nav-link" href="{{route('info')}}">Informationen</a>
        </li>
        <li class="nav-item" >
          <a class="nav-link" href="{{route('contact')}}">Kontakt</a>
        </li>
        <li class="nav-item" >
          <a class="nav-link" href="{{route('imprint')}}">Impressum</a>
        </li>
    </ul>
  </div>
</nav>

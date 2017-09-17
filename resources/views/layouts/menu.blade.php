<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="{{ route('home') }}">
        Ev Weiz
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="fa fa-bars"></span>
     </button>


  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link {{request()->is('über_uns') ? 'active' : ''}}" href="{{route('about')}}">
            Über uns
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{request()->is('veranstaltungen*') ? 'active' : ''}}" style="cursor: pointer" href="{{route('events')}}">Veranstaltungen</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{request()->is('sga') ? 'active' : ''}}" href="{{route('sga')}}">SGA</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{request()->is('info') ? 'active' : ''}}" href="{{route('info')}}">Informationen</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{request()->is('kontakt') ? 'active' : ''}}" href="{{route('contact')}}">Kontakt</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{request()->is('impressum') ? 'active' : ''}}" href="{{route('imprint')}}">Impressum</a>
        </li>
    </ul>
  </div>
</nav>
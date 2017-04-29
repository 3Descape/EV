<nav class="navbar fixed-top navbar-toggleable-md navbar-inverse " id="menu">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="{{ route('home') }}">Ev Weiz</a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto">
      <li class="{{ Route::currentRouteNamed('about') ? 'active nav-item' : 'nav-item' }}" >
        <a class="nav-link" href="{{ route('about') }}">Über uns <span class="sr-only">(current)</span></a>
      </li>
      <li class="{{ Route::currentRouteNamed('events') ? 'active nav-item' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('events')}}">Veranstaltungen</a>
      </li>
      <li class="{{ Route::currentRouteNamed('sga') ? 'active nav-item' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('sga') }}">SGA</a>
      </li>
      <li class="{{ Route::currentRouteNamed('info') ? 'active nav-item' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('info') }}">Informationen</a>
      </li>
      <li class="{{ Route::currentRouteNamed('contact') ? 'active nav-item' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('contact') }}">Kontakt</a>
      </li>
      <li class="{{ Route::currentRouteNamed('imprint') ? 'active nav-item' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('imprint') }}">Impressum</a>
      </li>
    </ul>
  </div>
</nav>

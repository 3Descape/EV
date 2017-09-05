<div class="container">
  <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/">Ev Weiz</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/über_uns">Über uns <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/veranstaltungen">Veranstaltungen</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/sga">SGA</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/info">Informationen</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/kontakt">Kontakt</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/impressum">Impressum</a>
        </li>
      </ul>

      <div class="nav-item dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            {{ Auth::user()->name }}
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();                                       document.getElementById('logout-form').submit();" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Logout</a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </div>
    </div>
  </nav>
</div>

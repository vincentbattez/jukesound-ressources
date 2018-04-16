<nav role="navigation" class="main-nav">
    <ul class="nav container">
      <li class="nav-item logo">
        <a href="{{ url('/items') }}" class="nav-link"> <img src="{{ asset('images/logo.svg') }}" alt="icon de jukesound administration"> </a>
      </li>
      <div class="pull-right">
        <li class="nav-item {{ Request::path() === 'items' ? 'active' : null }}">
          <a class="nav-link" href="{{ url('/items') }}">Liste des ressources</a>
        </li>
        <li class="nav-item {{ Request::path() === 'items/create' ? 'active' : null }}">
          <a class="nav-link" href="{{ url('/items/create') }}">Ajouter</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://www.jukebox-vintage.fr/wp-admin">Administration Jukesound</a>
        </li>
      </div>
    </ul>
</nav>
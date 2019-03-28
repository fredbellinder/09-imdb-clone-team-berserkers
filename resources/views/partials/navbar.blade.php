<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="nav-link" href="/">
      <img class="logo" width="125" src="{{ asset('assets/logo.svg') }}" />
    </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#featureContent" aria-controls="featureContent"
    aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

  <div class="collapse navbar-collapse" id="featureContent">
    <form class="form-inline my-2 my-lg-0" method="GET" action="/movies">
      <input name="query" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" required>
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#loginContent" aria-controls="loginContent"
      aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="loginContent">
      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif @else
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" v-pre>
            {{ Auth::user()->name }} <span class="caret"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
            <a class="dropdown-item" href="/watchlists">{{ __('Watchlists') }}</a>
            <a class="dropdown-item" href="/users">{{ __('Dashboard') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
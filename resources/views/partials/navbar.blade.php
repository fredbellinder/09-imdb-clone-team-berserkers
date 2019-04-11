<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="nav-link" href="/">
      <img class="logo" width="100" src="{{ asset('assets/logo.svg') }}" />
  </a>

  <div class="container justify-content-end">
    <button class="navbar-toggler btn btn-outline-success" style="height: 37px" type="button" data-toggle="collapse" data-target="#featureContent"
      aria-controls="featureContent" aria-expanded="false" aria-label="Toggle navigation">
    🔍
  </button>

    <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#loginContent" aria-controls="loginContent"
      aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
    <span class="navbar-toggler-icon"></span>
  </button>

    <div class="collapse navbar-collapse justify-self-end" id="featureContent">
      <form class="form-inline my-2 my-lg-0" method="GET" action="/search">
        <input name="query" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" required>
        <button class="btn btn-outline-success mr-1 my-2 my-sm-0" type="submit">Search</button>
        <a href="/advanced-search-view" class="btn btn-outline-success my-2 my-sm-0">Advanced Search</a>
      </form>
    </div>



    <div class="collapse navbar-collapse justify-content-end" id="loginContent">
      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav">
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
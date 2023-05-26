<nav class="navbar fixed-top navbar-expand-md navbar-dark bg-dark">
    {{-- style="background-color: #3A4A64" --}}
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
            <i class="bi bi-house-door-fill me-2"></i>
            BoolBnB
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            @auth
                <ul class="navbar-nav me-auto">
                    {{-- * ROTTA DASHBOARD CON STATISTICHE --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                            href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    {{-- * ROTTA LISTA APPARTAMENTI --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.apartments*') ? 'active' : '' }}"
                            href="{{ route('admin.apartments.index') }}">{{ __('Appartamenti') }}</a>
                    </li>
                    {{-- * ROTTA MESSAGGI RICEVUTI DAL FRONTEND --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.messages*') ? 'active' : '' }}"
                            href="{{ route('admin.messages.index') }}">{{ __('Messaggi') }}</a>
                    </li>
                    {{-- * ROTTA LISTA SPONSOR --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.sponsors*') ? 'active' : '' }}"
                            href="{{ route('admin.sponsors.index') }}">{{ __('Sponsor') }}</a>
                    </li>
                </ul>
            @endauth

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}"
                            href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}"
                                href="{{ route('register') }}">{{ __('Registrati') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown d-flex">
                        <i class="bi bi-person-circle text-white d-inline-block"
                            style="
            line-height: 40px;
            vertical-align: middle;
        "></i>
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->email }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-dark">
                            {{-- <a class="dropdown-item" href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a> --}}
                            <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Modifica profilo') }}</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

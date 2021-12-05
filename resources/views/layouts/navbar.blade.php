<nav class="navbar navbar-expand-md navbar-dark bg-white shadow-sm fixed-top w-100 py-0" style="z-index: 1500">
    <div class="container justify-content-center">

        <a class="navbar-brand d-block mr-0" href="{{ url('/') }}">
            {{ config('app.name', 'RFJScraper') }}
        </a>
        @if(Auth::user() != null)
        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon text-white"></span>
        </button>

        <div class="collapse navbar-collapse ml-3" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="/achievements" class="text-white ml-2 d-flex">
                            <h4 class="mdi mdi-trophy mb-0 h4">Досягнення</h4>
                        </a>
                    </li>
                        <li class="nav-item">
                            <a href="/" class="text-white ml-2 d-flex">
                                <h4 class="mdi mdi-folder-account mb-0 h4">Ставки</h4>
                            </a>
                        </li>
                    <li class="nav-item">
                        <a href="#сорі,_лапки_втомилися;)" class="text-white ml-2 d-flex">
                            <h4 class="mdi mdi-crown mb-0 h4">Мої ставки</h4>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/my-events" class="text-white ml-2 d-flex">
                            <h4 class="mdi mdi-calendar-alert mb-0 h4">Мої події</h4>
                        </a>
                    </li>
                </ul>

        <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                @else
                    <li class="nav-item dropdown">
                        <div class="mdi mdi-wallet h4 d-inline-block mb-0"><a class="text-decoration-none" style="color: yellow;" href="/balance">{{ Auth::user()->balance }}₴</a></div>
                        <a id="navbarDropdown" class="nav-link dropdown-toggle py-0 d-inline-block" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="font-size: 0.9rem;color: yellow">
                            <span class="mdi mdi-account h4"><span class="d-md-none">аккаунт</span> </span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('other.logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
            @endif
        </div>
    </div>
</nav>

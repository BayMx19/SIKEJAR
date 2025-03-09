<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <a class="navbar-brand brand-logo" href="{{''}}"><img src="{{asset('assets/images/LogoPosyandu.png')}}"
                alt="logo" style="width: 15%;" /> <b class="font-brand">Posyandu Jambu</b></a>
        <a class="navbar-brand brand-logo-mini" href="{{''}}"><img src="{{asset('assets/images/LogoPosyandu.png')}}"
                alt="logo" style="width: 100%;" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>

        <ul class="navbar-nav navbar-nav-right">

            <div class="nav-profile-text">
                <p class="mb-1 text-black"><b>{{ Auth::user()->username }}</b></p>
            </div>
            <li class="nav-item nav-logout d-none d-lg-block">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a class="nav-link" href="#"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="mdi mdi-power"></i>
                </a>
            </li>

        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>

        </ div>
</nav>
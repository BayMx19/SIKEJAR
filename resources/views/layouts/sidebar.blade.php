<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        <li class="nav-item">
            <a class="nav-link" href="{{'/home'}}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        @if(auth()->check() && auth()->user()->role === 'SuperAdmin')

        <li class="nav-item">
            <a class="nav-link" href="{{'/master-users'}}">
                <span class="menu-title">Master Users</span>
                <i class="mdi mdi-account-group menu-icon"></i>
            </a>
        </li>
        @endif
        @if(auth()->check() && auth()->user()->role === 'SuperAdmin')

        <li class="nav-item">
            <a class="nav-link" href="{{'/master-dokter'}}">
                <span class="menu-title">Master Dokter</span>
                <i class="mdi mdi-account menu-icon"></i>
            </a>
        </li>
        @endif
        @if(auth()->check() && (auth()->user()->role === 'SuperAdmin' || auth()->user()->role === 'Kader'))

        <li class="nav-item">
            <a class="nav-link" href="{{'/master-anak'}}">
                <span class="menu-title">Master Anak</span>
                <i class="mdi mdi-baby-face-outline menu-icon"></i>
            </a>
        </li>
        @endif
        @if(auth()->check() && (auth()->user()->role === 'SuperAdmin' || auth()->user()->role === 'Kader'))

        <li class="nav-item">
            <a class="nav-link" href="{{'/jadwal-imunisasi'}}">
                <span class="menu-title">Jadwal Imunisasi</span>
                <i class="mdi mdi-calendar-clock menu-icon"></i>
            </a>
        </li>
        @endif
        @if(auth()->check() && (auth()->user()->role === 'SuperAdmin' || auth()->user()->role === 'Kader'))

        <li class="nav-item">
            <a class="nav-link" href="{{'/status-imunisasi'}}">
                <span class="menu-title">Status Imunisasi</span>
                <i class="mdi mdi-needle menu-icon"></i>
            </a>
        </li>
        @endif
        @if(auth()->check() && (auth()->user()->role === 'SuperAdmin' || auth()->user()->role === 'Kader'))

        <li class="nav-item">
            <a class="nav-link" href="{{'/feedback'}}">
                <span class="menu-title">Feedback</span>
                <i class="mdi mdi-comment-quote-outline menu-icon"></i>
            </a>
        </li>
        @endif

    </ul>

</nav>

<nav class="sb-topnav navbar navbar-expand navbar-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.html">Resto Diniyyah Puteri</a>

    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
    </form>

    <ul class="navbar-nav ms-auto me-3 me-lg-4 align-items-center">
        <li class="nav-item dropdown">
            <a class="nav-link d-flex align-items-center gap-2" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="position-relative">
                    @empty(Auth::user()->foto)
                        <img src="{{ url('assets/img/user/nophoto.png') }}" alt="Profile" class="rounded-circle shadow" style="width: 38px; height: 38px; object-fit: cover;">
                    @else
                        <img src="{{ url('assets/img/user/') }}/{{ Auth::user()->foto }}" alt="Profile" class="rounded-circle shadow" style="width: 38px; height: 38px; object-fit: cover;">
                    @endempty
                    <span class="position-absolute bottom-0 end-0 translate-middle p-1 bg-success border border-light rounded-circle" style="width:10px;height:10px;"></span>
                </span>
                <span class="d-none d-md-inline fw-semibold text-white small">
                    {{ Auth::user()->name ?? '' }}
                </span>
                <i class="bi bi-chevron-down text-white small"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 animate__animated animate__fadeIn" aria-labelledby="profileDropdown" style="min-width: 220px;">
                <li class="px-3 py-2 text-center border-bottom bg-light rounded-top">
                    <div>
                        @empty(Auth::user()->foto)
                            <img src="{{ url('assets/img/user/nophoto.png') }}" alt="Profile" class="rounded-circle mb-2" style="width: 48px; height: 48px; object-fit: cover;">
                        @else
                            <img src="{{ url('assets/img/user/') }}/{{ Auth::user()->foto }}" alt="Profile" class="rounded-circle mb-2" style="width: 48px; height: 48px; object-fit: cover;">
                        @endempty
                    </div>
                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                    <div class="text-muted small">{{ Auth::user()->role }}</div>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ url('myprofil') }}">
                        <i class="bi bi-person-circle fs-5 text-primary"></i>
                        <span>My Profile</span>
                    </a>
                </li>
                @if(Auth::user()->role == 'Admin')
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ url('kelola_user') }}">
                            <i class="bi bi-gear fs-5 text-secondary"></i>
                            <span>Kelola User</span>
                        </a>
                    </li>
                @endif
                <li>
                    <hr class="dropdown-divider my-1">
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2 text-danger" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right fs-5"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
    </ul>
    
    
    
</nav>

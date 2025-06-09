<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Resto Diniyyah Puteri</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Modern, Restaurant, Template">
    <meta name="description" content="Resto Diniyyah Puteri - Modern Restaurant Template">

    <!-- Favicon -->
    <link href="{{ url('img/icon.png') }}" rel="icon">

    <!-- Custom Stylesheets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Owl Carousel (versi terbaru) -->
    <link href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.theme.default.min.css" rel="stylesheet">
    
    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Library tambahan (jika masih diperlukan) -->
    <link rel="stylesheet" href="{{ asset('assetsLand/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsLand/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsLand/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsLand/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsLand/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsLand/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsLand/css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsLand/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsLand/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsLand/css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @livewireStyles
</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-light py-3 animate__animated animate__fadeInDown">
            <a href="{{ url('/Home') }}" class="navbar-brand px-lg-4 m-0 logo-container">
                <img src="{{ asset('img/logoo.png') }}" alt="Logo" title="Home" width="130" height="auto" />
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4">
                    <a href="{{ url('/Home') }}" class="nav-item nav-link {{ request()->is('Home') ? 'active text-secondary fw-bold' : 'text-light fw-bold' }}">Home</a>
                    <a href="{{ url('/about') }}" class="nav-item nav-link {{ request()->is('about') ? 'active text-secondary fw-bold' : 'text-light fw-bold' }}" style="margin-left: 10px;">About</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle {{ request()->is('testi*') ? 'active text-secondary fw-bold' : 'text-light fw-bold' }}" data-bs-toggle="dropdown" style="margin-left: 10px;">Testimonial</a>
                        <div class="dropdown-menu text-capitalize">
                            <a href="{{ url('/testi') }}" class="dropdown-item fw-bold">
                                <i class="bi bi-chat-quote-fill"></i>
                                <span style="padding-left: 10px;"> Lihat Testimoni</span>
                            </a>
                            <hr class="dropdown-divider">
                            <a href=" {{ route('testi_user.create') }}" class="dropdown-item fw-bold">
                                <i class="bi bi-envelope-heart"></i>
                                <span style="padding-left: 10px;"> Kirim Testimoni </span>
                            </a>
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle {{ request()->is('menu*') ? 'active text-secondary fw-bold' : 'text-light fw-bold' }}" data-bs-toggle="dropdown" style="margin-left: 10px;">Menu</a>
                        <div class="dropdown-menu text-capitalize">
                            <a href="{{ url('/menupelanggan') }}" class="dropdown-item fw-bold">
                                <i class="bi bi-menu-up"></i>
                                <span style="padding-left: 10px;"> Lihat Menu</span>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="{{ route('cart.create') }}" class="dropdown-item fw-bold">
                                <i class="bi bi-bag-check"></i>
                                <span style="padding-left: 10px;"> Pesan Menu</span>
                            </a>
                        </div>
                    </div>

                    @if(empty(Auth::user()))
                        <a href="{{ url('/login') }}" class="nav-item nav-link {{ request()->is('login') ? 'active text-secondary fw-bold' : 'text-light fw-bold' }}" style="margin-left: 10px; margin-right: 40px; ">LogIn</a>
                    @else
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle {{ request()->is('cart*') || request()->is('metode-pembayaran') || request()->is('bayar') ? 'active text-secondary fw-bold' : 'text-light fw-bold' }}" data-bs-toggle="dropdown" style="margin-left: 10px;">Pesanan</a>
                            <div class="dropdown-menu text-capitalize">
                                <a href="{{ url('/cart') }}" class="dropdown-item fw-bold">
                                    <i class="bi bi-cart-plus-fill"></i>
                                    <span style="padding-left: 10px;"> Pesanan Ku </span>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="{{ url('/metode-pembayaran') }}" class="dropdown-item fw-bold">
                                    <i class="bi bi-envelope-paper bi bi-cash"></i>
                                    <span style="padding-left: 10px;"> Metode Pembayaran</span>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="{{ url('bayar') }}" class="dropdown-item fw-bold">
                                    <i class="bi bi-hourglass-split"></i>
                                    <span style="padding-left: 10px;"> Status Pembayaran </span>
                                </a>
                            </div>
                        </div> 
                        <div class="d-flex align-items-center ms-3">
                            <div class="profile-picture-wrapper">
                                @empty(Auth::user()->foto)
                                    <img src="{{ url('assets/img/user/nophoto.png') }}" alt="Profile" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <img src="{{ url('assets/img/user/')}}/{{Auth::user()->foto}}" alt="Profile" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                @endempty
                            </div>
                        </div>

                        <!-- Navbar Profile -->
                        <div class="nav-item dropdown" style="margin-right: 50px;">
                            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center {{ request()->is('myprofil') || request()->is('logout') ? 'active text-secondary fw-bold' : 'text-light fw-bold' }}" data-bs-toggle="dropdown">
                                <span class="d-none d-md-block ps-2" style="margin-left: 5px;">
                                    @if(empty(Auth::user()->name))
                                        {{ '' }}
                                    @else
                                        {{ Auth::user()->name }}
                                    @endif
                                </span>
                            </a>
                            <div class="dropdown-menu text-capitalize">
                                <span class="d-none d-md-block text-center ps-2 fw-bold" style="font-size: 16px;">
                                    @if(empty(Auth::user()->name))
                                        {{ '' }}
                                    @else
                                        {{ Auth::user()->name }}
                                    @endif
                                </span>
                                <span class="d-none d-md-block text-center ps-2 fw-bold" style="font-size: 14px;">
                                    @if(empty(Auth::user()->role))
                                        {{ '' }}
                                    @else
                                        {{ Auth::user()->role }}
                                    @endif
                                </span>
                                <hr class="dropdown-divider">
                                <a href="{{ url('/myprofil') }}" class="dropdown-item fw-bold">
                                    <i class="bi bi-person" style="margin-right: 10px;"></i>
                                    <span>My Profile</span>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="{{ route('logout') }}" class="dropdown-item fw-bold"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right" style="margin-right: 10px;"></i>
                                    <span>Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <!-- Include Bootstrap JS -->
    
</body>

</html>

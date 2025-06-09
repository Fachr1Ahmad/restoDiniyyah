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

    <!-- Google Font: Lato (alternatif yang simple dan elegan) -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    
    <!-- Owl Carousel (versi terbaru) -->
    <link href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.theme.default.min.css" rel="stylesheet">

    <!-- Tempus Dominus Bootstrap 5 (versi terbaru) -->
    <link href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.0.0-beta.4/dist/css/tempus-dominus.min.css" rel="stylesheet">

    <!-- Bootstrap CSS (versi terbaru 5.3.3) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUa6mY6Pp4sIDp+I7o9VVNE6+W9Qd+K5Zj5H6J5QK6B3+4qL5M/kp4NJtYBl" crossorigin="anonymous">

    <!-- Bootstrap Icons (versi terbaru) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <!-- Custom Stylesheets -->
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
</head>



<body>
    <!-- Navbar Start -->
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            
            <a href="/home" class="navbar-brand px-lg-4 m-0">
                <img src="img/logoo.png" alt="" title="" width="70" height="auto" />
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4">
                    <a href="{{ url('/Home') }}" class="nav-item nav-link active">Home</a>
                    <a href="{{ url('/about') }}" class="nav-item nav-link" style="margin-left: 10px;">About</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="margin-left: 10px;">Testimonial</a>
                        <div class="dropdown-menu text-capitalize">
                            <a href="{{ url('/testi') }}" class="dropdown-item">
                                <i class="bi bi-chat-quote-fill"></i>
                                <span style="padding-left: 10px;"> Lihat Testimoni</span>
                            </a>
                            <hr class="dropdown-divider">
                            <a href=" {{ route('testi_user.create') }}" class="dropdown-item">
                                <i class="bi bi-envelope-heart"></i>
                                <span style="padding-left: 10px;"> Kirim Testimoni </span>
                            </a>
                        </div>
                    </div> 
                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="margin-left: 10px;">Menu</a>
                        <div class="dropdown-menu text-capitalize">
                            <a href="{{ url('/menupelanggan') }}" class="dropdown-item">
                                <i class="bi bi-menu-up"></i>
                                <span style="padding-left: 10px;"> Lihat Menu</span>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="{{ route('cart.create') }}" class="dropdown-item">
                                <i class="bi bi-bag-check"></i>
                                <span style="padding-left: 10px;"> Pesan Menu</span>
                            </a>
                        </div>
                    </div> 
                    
                    @if(empty(Auth::user()))
                        <a href="{{ url('/login') }}" class="nav-item nav-link" style="margin-left: 10px; margin-right: 40px; ">LogIn</a>
                    @else
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="margin-left: 10px;">Pesanan</a>
                            <div class="dropdown-menu text-capitalize">
                                <a href="{{ url('/cart') }}" class="dropdown-item">
                                    <i class="bi bi-cart-plus-fill"></i>
                                    <span style="padding-left: 10px;"> Pesanan Ku </span>
                                </a>

                                <hr class="dropdown-divider">
                                <a href="{{ url('/metode-pembayaran') }}" class="dropdown-item">
                                    <i class="bi bi-envelope-paper bi bi-cash"></i>
                                    <span style="padding-left: 10px;"> Metode Pembayaran</span>
                                </a>

                                <hr class="dropdown-divider">

                                <hr class="dropdown-divider">
                                <a href="{{ url('bayar') }}" class="dropdown-item">
                                    <i class="bi bi-hourglass-split"></i>
                                    <span style="padding-left: 10px;"> Status Pembayaran </span>
                                </a>
                            </div>
                        </div> 
                        @empty(Auth::user()->foto)
                            <img src="{{ url('assets/img/user/nophoto.png') }}" alt="Profile"  style="width: 50px; height: 50px; border-radius: 100%; margin-left: 10px;">
                        @else
                            <img src="{{ url('assets/img/user/')}}/{{Auth::user()->foto}}" alt="Profile" style="width: 50px; height: 50px; border-radius: 100%; margin-left: 10px;">
                        @endempty


                        <!-- Navbar-->
                        <div class="nav-item dropdown" style="margin-right: 50px;">
                            <a class="nav-link nav-profile d-flex align-items-center " href="#" data-bs-toggle="dropdown">     
                                
                                <span class="d-none d-md-block dropdown-toggle ps-2" style="margin-left: 5px;">
                                    @if(empty(Auth::user()->name))
                                        {{ '' }}
                                    @else
                                        {{ Auth::user()->name }}
                                    @endif
                                </span>
                            
                            </a><!-- End Profile Iamge Icon -->

                            <div class="dropdown-menu text-capitalize">
                                <span class="d-none d-md-block text-center ps-2" style="font-weight: bold; font-size: 16px;">
                                    @if(empty(Auth::user()->name))
                                        {{ '' }}
                                    @else
                                        {{ Auth::user()->name }}
                                    @endif
                                </span>
                                <span class="d-none d-md-block text-center ps-2" style="font-size: 14px; ">
                                    @if(empty(Auth::user()->role))
                                        {{ '' }}
                                    @else
                                        {{ Auth::user()->role }}
                                    @endif
                                </span>
                                
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ url('/myprofil') }}">
                                        <i class="bi bi-person" style="margin-right: 10px;"></i>
                                        <span>My Profile</span>
                                    </a>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            <i class="bi bi-box-arrow-right" style="margin-right: 10px;"></i> {{ __('Logout') }}
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
</body>

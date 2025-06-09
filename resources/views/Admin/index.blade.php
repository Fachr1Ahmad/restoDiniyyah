@if(Auth::user()->role != 'Customer')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Administrator Restoran Diniyyah Puteri</title>

    <link href="{{ url('assets/img/icon.png') }}" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />   
    <link href="{{ url('assets/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    
</head>

<body class="sb-nav-fixed">
    @include('sweetalert::alert')
    @include('Admin.navbar')

    <div id="layoutSidenav">
        @include('Admin.sidenav')

        @if(Auth::user()->role != 'Customer')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <marquee class="mt-4 p-3 fw-bold" style="background-color: gainsboro;">Selamat Datang di Restoran Diniyyah Puteri </marquee>
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Restoran Diniyyah Puteri</li>
                    </ol>

                    <!-- Card Section for Dashboard Overview -->
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-light text-dark mb-4 shadow-sm">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Data Users</h5>
                                    <p>Manage all users</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between bg-light">
                                    <a class="small text-dark btn btn-sm" href="{{ url('/kelola_user') }}">View Details</a>
                                    <div class="small text-dark btn btn-sm"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-light text-dark mb-4 shadow-sm">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Data Menu</h5>
                                    <p>Manage menu items</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between bg-light">
                                    <a class="small text-dark btn btn-sm" href="{{ url('/menu') }}">View Details</a>
                                    <div class="small text-dark btn btn-sm"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-light text-dark mb-4 shadow-sm">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Data Meja</h5>
                                    <p>Manage seating arrangements</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between bg-light">
                                    <a class="small text-dark btn btn-sm" href="{{ url('/meja') }}">View Details</a>
                                    <div class="small text-dark btn btn-sm"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-light text-dark mb-4 shadow-sm">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Data Kategori</h5>
                                    <p>Manage categories</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between bg-light">
                                    <a class="small text-dark btn btn-sm" href="{{ url('/kategori') }}">View Details</a>
                                    <div class="small text-dark btn btn-sm"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-light text-dark mb-4 shadow-sm">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Data Pesanan</h5>
                                    <p>Manage customer orders</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between bg-light">
                                    <a class="small text-dark btn btn-sm" href="{{ url('/pesanan') }}">View Details</a>
                                    <div class="small text-dark btn btn-sm"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-light text-dark mb-4 shadow-sm">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Data Pembayaran</h5>
                                    <p>Manage payment details</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between bg-light">
                                    <a class="small text-dark btn btn-sm" href="{{ url('/pembayaran') }}">View Details</a>
                                    <div class="small text-dark btn btn-sm"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-light text-dark mb-4 shadow-sm">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Testimoni</h5>
                                    <p>Manage customer feedback</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between bg-light">
                                    <a class="small text-dark btn btn-sm" href="{{ url('/testimoni') }}">View Details</a>
                                    <div class="small text-dark btn btn-sm"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- End Card Section for Dashboard Overview -->

                    <!-- Charts Section -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card shadow-sm border-light mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Grafik Users</h5>

                                    <!-- Pie Chart -->
                                    <canvas id="pieChart" style="max-height: 400px;"></canvas>
                                    <script>
                                        var lbl2 = [@foreach($ar_role as $role) '{{ $role->role }}', @endforeach];
                                        var jml = [@foreach($ar_role  as $role) {{ $role->jumlah }}, @endforeach];
                                        document.addEventListener("DOMContentLoaded", () => {
                                            new Chart(document.querySelector('#pieChart'), {
                                                type: 'pie',
                                                data: {
                                                    labels: lbl2,
                                                    datasets: [{
                                                        label: 'My First Dataset',
                                                        data: jml,
                                                        backgroundColor: [
                                                            'rgba(54, 162, 235, 0.6)', // Soft Blue
                                                            'rgba(75, 192, 192, 0.6)', // Soft Teal
                                                            'rgba(153, 102, 255, 0.6)', // Soft Purple
                                                            'rgba(255, 159, 64, 0.6)',  // Soft Orange
                                                            'rgba(255, 99, 132, 0.6)'   // Soft Red
                                                        ],
                                                        hoverOffset: 4,
                                                        borderWidth: 2
                                                    }]
                                                },
                                                options: {
                                                    responsive: true, // Makes the chart responsive
                                                    plugins: {
                                                        tooltip: {
                                                            backgroundColor: 'rgba(0, 0, 0, 0.7)', // Dark background for tooltip
                                                            titleColor: 'white',
                                                            bodyColor: 'white'
                                                        },
                                                        legend: {
                                                            position: 'top',
                                                            labels: {
                                                                font: {
                                                                    size: 14
                                                                },
                                                                color: 'black' // Color of legend text
                                                            }
                                                        }
                                                    }
                                                }
                                            });
                                        });
                                    </script>
                                    <!-- End Pie Chart -->
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 mt-2">
                            <h5 class="card-title text-center">Grafik Stok Menu</h5>
                            <canvas id="barChart" style="max-height: 400px;"></canvas>
                            <script>
                                var lbl = [@foreach($ar_menu as $menu) '{{ $menu->namaMenu }}', @endforeach];
                                var hrt = [@foreach($ar_menu as $menu) {{ $menu->stok }}, @endforeach];
                                // Array of more colors for larger datasets
                                var barColors = [
                                    'rgba(54, 162, 235, 0.6)',  // Soft Blue
                                    'rgba(75, 192, 192, 0.6)',  // Soft Teal
                                    'rgba(153, 102, 255, 0.6)', // Soft Purple
                                    'rgba(255, 159, 64, 0.6)',  // Soft Orange
                                    'rgba(255, 99, 132, 0.6)',  // Soft Red
                                    'rgba(255, 205, 86, 0.6)',  // Soft Yellow
                                    'rgba(40, 167, 69, 0.6)',   // Soft Green
                                    'rgba(23, 162, 184, 0.6)',  // Soft Cyan
                                    'rgba(108, 117, 125, 0.6)', // Soft Gray
                                    'rgba(220, 53, 69, 0.6)',   // Soft Crimson
                                    'rgba(255, 193, 7, 0.6)',   // Soft Amber
                                    'rgba(0, 123, 255, 0.6)',   // Soft Azure
                                    'rgba(111, 66, 193, 0.6)',  // Soft Violet
                                    'rgba(255, 87, 34, 0.6)',   // Soft Deep Orange
                                    'rgba(76, 175, 80, 0.6)',   // Soft Light Green
                                    'rgba(233, 30, 99, 0.6)',   // Soft Pink
                                    'rgba(63, 81, 181, 0.6)',   // Soft Indigo
                                    'rgba(0, 150, 136, 0.6)',   // Soft Teal
                                    'rgba(205, 220, 57, 0.6)',  // Soft Lime
                                    'rgba(121, 85, 72, 0.6)'    // Soft Brown
                                ];
                                var borderColors = [
                                    'rgb(54, 162, 235)',
                                    'rgb(75, 192, 192)',
                                    'rgb(153, 102, 255)',
                                    'rgb(255, 159, 64)',
                                    'rgb(255, 99, 132)',
                                    'rgb(255, 205, 86)',
                                    'rgb(40, 167, 69)',
                                    'rgb(23, 162, 184)',
                                    'rgb(108, 117, 125)',
                                    'rgb(220, 53, 69)',
                                    'rgb(255, 193, 7)',
                                    'rgb(0, 123, 255)',
                                    'rgb(111, 66, 193)',
                                    'rgb(255, 87, 34)',
                                    'rgb(76, 175, 80)',
                                    'rgb(233, 30, 99)',
                                    'rgb(63, 81, 181)',
                                    'rgb(0, 150, 136)',
                                    'rgb(205, 220, 57)',
                                    'rgb(121, 85, 72)'
                                ];
                                // Repeat colors if menu count exceeds color array length
                                function getColorArray(arr, count) {
                                    var out = [];
                                    for (var i = 0; i < count; i++) {
                                        out.push(arr[i % arr.length]);
                                    }
                                    return out;
                                }
                                document.addEventListener("DOMContentLoaded", () => {
                                    new Chart(document.querySelector('#barChart'), {
                                        type: 'bar',
                                        data: {
                                            labels: lbl,
                                            datasets: [{
                                                label: 'Stok Menu',
                                                data: hrt,
                                                backgroundColor: getColorArray(barColors, lbl.length),
                                                borderColor: getColorArray(borderColors, lbl.length),
                                                borderWidth: 1,
                                                hoverBackgroundColor: 'rgba(0, 123, 255, 0.6)',
                                                hoverBorderColor: 'rgba(0, 123, 255, 1)'
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            scales: {
                                                y: {
                                                    beginAtZero: true,
                                                    grid: {
                                                        color: 'rgba(0, 0, 0, 0.1)'
                                                    },
                                                    ticks: {
                                                        font: {
                                                            size: 14
                                                        },
                                                        color: 'black'
                                                    }
                                                },
                                                x: {
                                                    grid: {
                                                        color: 'rgba(0, 0, 0, 0.1)'
                                                    },
                                                    ticks: {
                                                        font: {
                                                            size: 14
                                                        },
                                                        color: 'black'
                                                    }
                                                }
                                            },
                                            plugins: {
                                                tooltip: {
                                                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                                                    titleColor: 'white',
                                                    bodyColor: 'white',
                                                    footerColor: 'white',
                                                    padding: 10
                                                },
                                                legend: {
                                                    position: 'top',
                                                    labels: {
                                                        font: {
                                                            size: 14
                                                        },
                                                        color: 'black'
                                                    }
                                                }
                                            }
                                        }
                                    });
                                });
                            </script>
                            
                        </div>
                    </div>

                    <div class="card mb-4 shadow-sm border-light">
                        <div class="card-header bg-light d-flex align-items-center">
                            <i class="fas fa-table me-1"></i>
                            <span class="ms-2">Data Pesanan</span>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12 ftco-animate" wire:poll.keep-alive>
                                @livewire('pesanan', ['pesanan' => $pesanan->take(5)])
                            </div>
                        </div>
                        <div class="card-footer bg-light text-end">
                            <a href="{{ url('/pesanan') }}" class="small text-primary">Lihat Semua</a>
                        </div>
                    </div>
                        
                    @yield('content')
                </div>
            </main>
            @include('Admin.footer')
        </div>
        @else
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <marquee class="mt-4 p-3 fw-bold" style="font-size: medium; background-color: gainsboro;">Selamat Datang di Restoran Diniyyah Puteri </marquee>
                    <div class="section-title">
                        <h2 class="text-center" style="color: brown; margin-top: 30px;">Restoran Diniyyah Puteri</h2>
                    </div>
                    

                    <div class="row" style="justify-content: center; margin-bottom: 50px; margin-top: 40px;">
                        <div class="col-xl-6 mt-2">
                            <h5 class="card-title text-center mb-3">Daftar Stok Menu</h5>
                            <canvas id="barChart" style="max-height: 400px;"></canvas>
                            <script>
                                // Chart logic here
                            </script>
                        </div>
                    </div>

                    @include('Admin.footer')
                </div>
            </main>
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('assets/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ url('assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ url('assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="{{ url('assets/js/datatables-simple-demo.js') }}"></script>
</body>

</html>
@else
@include('master')
@endif

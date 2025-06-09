<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion"> <!-- Ganti sb-sidenav-dark dengan sb-sidenav-light -->
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading text-dark">Core</div> <!-- Menambahkan class text-dark untuk teks hitam -->
                <a class="nav-link text-dark" href="{{ url('/dashboard') }}"> <!-- Menambahkan class text-dark untuk teks hitam -->
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading text-dark">Manage Data Master</div> <!-- Menambahkan class text-dark untuk teks hitam -->
                <a class="nav-link collapsed text-dark" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts"> <!-- Menambahkan class text-dark untuk teks hitam -->
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Data Master
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link text-dark" href="{{ url('/menu') }}">Data Menu</a> <!-- Menambahkan class text-dark untuk teks hitam -->
                        <a class="nav-link text-dark" href="{{ url('/meja') }}">Data Meja</a> <!-- Menambahkan class text-dark untuk teks hitam -->
                        <a class="nav-link text-dark" href="{{ url('/kategori') }}">Data Kategori</a> <!-- Menambahkan class text-dark untuk teks hitam -->
                        <a class="nav-link text-dark" href="{{ url('/testimoni') }}">Data Testimoni</a> <!-- Menambahkan class text-dark untuk teks hitam -->
                    </nav>
                </div>
                @if(Auth::user()->role != 'Customer')
                <div class="sb-sidenav-menu-heading text-dark">Manage Data Pesanan</div> <!-- Menambahkan class text-dark untuk teks hitam -->
                    <a class="nav-link collapsed text-dark" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages"> <!-- Menambahkan class text-dark untuk teks hitam -->
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Pesanan
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link text-dark" href="{{ url('/pesanan') }}">Data Pesanan</a> <!-- Menambahkan class text-dark untuk teks hitam -->
                            <a class="nav-link text-dark" href="{{ url('/pembayaran') }}">Data Pembayaran</a> <!-- Menambahkan class text-dark untuk teks hitam -->
                        </nav>
                    </div>
                @endif
                @if(Auth::user()->role == 'Admin')
                <div class="sb-sidenav-menu-heading text-dark">Manage Data Users</div> <!-- Menambahkan class text-dark untuk teks hitam -->
                    <a class="nav-link text-dark" href="{{ url('/kelola_user') }}"> <!-- Menambahkan class text-dark untuk teks hitam -->
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Kelola Data Users
                    </a>
                @endif
            </div>
        </div>
        <div class="sb-sidenav-footer text-light ps-3"> 
            <div class="small">Powered By:</div>
            <strong>Diniyyah Resto</strong>
        </div>
    </nav>
</div>

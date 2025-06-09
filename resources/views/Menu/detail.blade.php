@extends('Admin.home')
@section('content')
<section class="section profile">
    <div class="container py-4">
        <h2 class="mb-4">Dashboard</h2>
        <nav>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ url('menu') }}" class="text-decoration-none text-dark">Menu</a></li>
                <li class="breadcrumb-item active">Detail Menu</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detail Menu</h5>
                        <a href="{{ url('menu') }}" class="btn btn-light btn-sm fw-bold">
                            <i class="fa fa-arrow-circle-left"></i> Back
                        </a>
                    </div>
                    <div class="card-body text-center">
                        @empty($row->foto)
                        <img src="{{ url('assets/img/menu/nophoto.png') }}" alt="No Photo" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                        <img src="{{ url('assets/img/menu/'.$row->foto) }}" alt="{{ $row->namaMenu }}" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        @endempty
                        <h3 class="mt-3">{{ $row->namaMenu }}</h3>
                        <span class="badge bg-{{ $row->status == 'Available' ? 'success' : 'danger' }} mb-3">{{ $row->status }}</span>
                        <div class="alert alert-light border mt-3">
                            <p class="mb-1"><strong>Harga:</strong> Rp {{ number_format($row->harga, 0, ',', '.') }}</p>
                            <p class="mb-1"><strong>Stok:</strong> {{ $row->stok }}</p>
                            <p class="mb-0"><strong>Kategori:</strong> {{ $row->kategori->namaKategori }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

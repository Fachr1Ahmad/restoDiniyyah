@extends('Admin.home')
@section('content')
<section class="section profile">
    <div class="container py-4">
        <h2 class="mb-4">Dashboard</h2>
        <nav>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ url('pembayaran') }}" class="text-decoration-none text-dark">Pembayaran</a></li>
                <li class="breadcrumb-item active">Detail Pembayaran</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detail Pembayaran</h5>
                        <a href="{{ url('pembayaran') }}" class="btn btn-light btn-sm fw-bold">
                            <i class="fa fa-arrow-circle-left"></i> Back
                        </a>
                    </div>
                    <div class="card-body text-center">
                        @empty($row->buktiPembayaran)
                        <img src="{{ url('assets/img/bukti/nophoto.png') }}" alt="No Photo" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                        <img src="{{ url('assets/img/bukti/'.$row->buktiPembayaran) }}" alt="Bukti Pembayaran" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        @endempty
                        <h3 class="mt-3">Nama Pemesan: {{ $row->pesanan->user->name }}</h3>
                        <h5 class="mt-3">Metode Pembayaran: {{ $row->metodePembayaran->metodePembayaran }}</h5>
                        <div class="alert alert-light border mt-3">
                            <p class="mb-1"><strong>Kode Pesanan:</strong> {{ $row->pesanan->order_id }}</p>
                            <p class="mb-1"><strong>Tanggal Pembayaran:</strong> {{ $row->updated_at }}</p>
                            <p class="mb-0"><strong>Status Pembayaran:</strong> {{ $row->statusPembayaran }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
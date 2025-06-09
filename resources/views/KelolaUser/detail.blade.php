@extends('Admin.home')
@section('content')
@if(Auth::user()->role == 'Admin')
<section class="section profile">
    <div class="container py-4">
        <h2 class="mb-4">Dashboard</h2>
        <nav>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ url('kelola_user') }}" class="text-decoration-none text-dark">Kelola User</a></li>
                <li class="breadcrumb-item active">Detail Kelola User</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detail Kelola User</h5>
                        <a href="{{ url('kelola_user') }}" class="btn btn-light btn-sm fw-bold">
                            <i class="fa fa-arrow-circle-left"></i> Back
                        </a>
                    </div>
                    <div class="card-body text-center">
                        @empty($row->foto)
                        <img src="{{ url('assets/img/user/nophoto.png') }}" alt="No Photo" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                        <img src="{{ url('assets/img/user/'.$row->foto) }}" alt="{{ $row->name }}" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        @endempty
                        <h3 class="mt-3">{{ $row->name }}</h3>
                        <h4>{{ $row->role }}</h4>
                        <span class="badge bg-{{ $row->isactive == 1 ? 'success' : 'danger' }} mb-3">
                            {{ $row->isactive == 1 ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                        <div class="alert alert-light border mt-3">
                            <p class="mb-1"><strong>Email:</strong> {{ $row->email }}</p>
                            <p class="mb-1"><strong>No HP:</strong> {{ $row->no_hp }}</p>
                            <p class="mb-0"><strong>Alamat:</strong> {{ $row->alamat }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@else
    @include('Admin.access_denied')
@endif
@endsection
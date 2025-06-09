@extends('Admin.home')
@section('content')
<section class="section profile">
    <h2 style="margin: 10px 0px 10px 10px; ">Dashboard</h2>
        <nav>
            <ol class="breadcrumb mb-4 " style="margin-left: 10px;">
                <li class="breadcrumb-item"><a style="text-decoration: none; color: black;" href="{{ url('testimoni') }}">Testimoni</a></li>
                <li class="breadcrumb-item active">Detail Testimoni</li>
            </ol>
        </nav>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Testimoni</h5>
                    <a href="{{ url('testimoni') }}" class="btn btn-light btn-sm fw-bold">
                        <i class="fa fa-arrow-circle-left"></i> Back
                    </a>
                </div>
                <div class="card-body text-center">
                    @empty($row->users->foto)
                    <img src="{{ url('assets/img/menu/nophoto.png') }}" alt="No Photo" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                    <img src="{{ url('assets/img/menu/'.$row->users->foto) }}" alt="{{ $row->users->name }}" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    @endempty
                    <h3 class="mt-3">{{ $row->users->name }}</h3>
                    <h5>{{ $row->users->role }}</h5>
                    <h5>{{ $row->users->alamat }}</h5>
                    <div class="alert alert-light border mt-3" style="width: 300px; margin: 0 auto;">
                        <p class="mb-1"><strong>Tanggal:</strong> {{ $row->date }}</p>
                        <p class="mb-0"><strong>Isi Pesan:</strong> {{ $row->pesan }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection
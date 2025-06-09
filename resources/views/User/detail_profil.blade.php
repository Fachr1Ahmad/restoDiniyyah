@extends('User.imyprofil')
@section('content')

<!-- Page Header -->
<div class="container-fluid p-0 mb-5 page-header" style="height: 400px; display: flex; align-items: center; justify-content: center;">
    <div class="text-center">
        <h3 class="display-4 mb-0 mt-lg-5 text-light font-weight-bold" style="font-size: 3rem;">My Profile</h3>
        <div class="d-inline-flex mb-lg-5">
            <p class="m-0 text-secondary font-weight-bold"><a class="text-secondary font-weight-bold m-0" href="/Home">Home</a></p>
            <p class="m-0 text-secondary font-weight-bold px-2">/</p>
            <p class="m-0 text-secondary font-weight-bold"><a class="text-secondary font-weight-bold m-0" href="{{ url('/myprofil') }}">MyProfile</a></p>
            <p class="m-0 text-secondary font-weight-bold px-2">/</p>
            <p class="m-0 text-secondary font-weight-bold"><a class="text-secondary font-weight-bold m-0" href="{{ url('') }}">Detail Profile</a></p>
        </div>
    </div>
</div>
    <!-- Page Header End -->

<section class="section profile">
    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4">
                    <h5 class="mb-0 fw-bold">Detail Profile</h5>
                    <a class="btn btn-light btn-sm fw-bold" title="Kembali" href="{{ url('myprofil') }}">
                        <i class="fa fa-arrow-circle-left"></i> Back
                    </a>
                </div>
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="profile-img mb-3">
                        @empty($row->foto)
                        <img src="{{ url('assets/img/user/nophoto.png') }}" alt="Profile" class="rounded-circle border border-3 border-warning shadow" width="150" height="150" style="object-fit:cover;">
                        @else
                        <img src="{{ url('assets/img/user/'.$row->foto) }}" alt="Profile" class="rounded-circle border border-3 border-warning shadow" width="150" height="150" style="object-fit:cover;">
                        @endempty
                    </div>
                    <h3 class="mt-2 mb-1 fw-bold text-primary">{{ $row->name }}</h3>
                    <span class="badge bg-primary text-light mb-3 px-3 py-2 fs-6">{{ $row->role }}</span>
                    <ul class="list-group w-75 mb-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="fw-semibold"><i class="fa fa-envelope me-2 text-warning"></i>Email</span>
                            <span>{{ $row->email }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="fw-semibold"><i class="fa fa-phone me-2 text-warning"></i>No HP</span>
                            <span>{{ $row->no_hp }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="fw-semibold"><i class="fa fa-map-marker-alt me-2 text-warning"></i>Alamat</span>
                            <span>{{ $row->alamat }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
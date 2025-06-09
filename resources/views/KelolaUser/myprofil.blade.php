@extends('Admin.home')
@section('content')
<section class="section profile">
    <h2 style="margin: 10px 0px 10px 10px; ">Dashboard</h2>
        <nav>
            <ol class="breadcrumb mb-4 " style="margin-left: 10px;">
                <li class="breadcrumb-item"><a style="text-decoration: none; color: black;" href="{{ url('administrator') }}">Home</a></li>
                <li class="breadcrumb-item active">My Profile</li>
            </ol>
        </nav>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="mt-4" style="width:550px; margin-left:18px;">
                    <a class="btn btn-warning btn-sm fw-bold" title="Kembali" 
                        href=" {{ url('administrator') }}">
                        <i class="fa fa-arrow-circle-left"></i> Back
                    </a>
                </div>

                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    @empty(Auth::user()->foto )
                    <img src="{{ url('assets/img/user/nophoto.png') }}" alt="Profile" width="150px">
                    @else
                    <img src="{{ url('assets/img/user/'. Auth::user()->foto ) }}" alt="Profile" width="150px">
                    @endempty
                    <h3 class="mt-3">{{ Auth::user()->name }}</h3>
                    <h4>{{ Auth::user()->role }}</h4>
                    <p class="mt-2 badge text-white {{ (  Auth::user()->isactive == 1  ) ? 'bg-success' : 'bg-danger'}}">
                        {{ ( Auth::user()->isactive == 1 ) ? 'Aktif' : 'Tidak Aktif'}}
                        </p>
                </div>
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="alert alert-warning d-flex flex-column align-items-center" style="width:300px; ">
                        Email : {{ Auth::user()->email }}
                        <br/>
                        No HP : {{ Auth::user()->no_hp }}
                        <br/>Alamat : {{ Auth::user()->alamat }}
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

@endsection
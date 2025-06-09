@extends('User.imyprofil')
@section('content')
@php
$ar_role = ['Admin','Kasir','Customer'];
@endphp

<!-- Page Header -->
<div class="container-fluid p-0 mb-5 page-header" style="height: 400px; display: flex; align-items: center; justify-content: center;">
    <div class="text-center">
	    <h3 class="display-4 mb-0 mt-lg-5 text-light font-weight-bold" style="font-size: 3rem;">My Profile</h3>
        <div class="d-inline-flex mb-lg-5">
			<p class="m-0 text-secondary font-weight-bold"><a class="text-secondary font-weight-bold m-0" href="/Home">Home</a></p>
            <p class="m-0 text-secondary font-weight-bold px-2">/</p>
            <p class="m-0 text-secondary font-weight-bold"><a class="text-secondary font-weight-bold m-0" href="{{ url('/myprofil') }}">MyProfile</a></p>
            <p class="m-0 text-secondary font-weight-bold px-2">/</p>
            <p class="m-0 text-secondary font-weight-bold"><a class="text-secondary font-weight-bold m-0" href="{{ url('') }}">Edit</a></p>
		</div>
    </div>
</div>
    
    <!-- Page Header End -->

    <div class="container-fluid py-5 mt-3">
        <div class="container">
            <a class="btn btn-warning btn-sm fw-bold" title="Kembali" 
                href=" {{ url('myprofil') }}" style="margin-bottom: 20px; border-radius: 5px;">
                <i class="fa fa-arrow-circle-left" ></i> Back
            </a>

            <div class="reservation position-relative">
                <div class="row align-items-center" style="padding: 40px;">
                    
                    <div class="card-body col-lg-12 my-5 my-lg-0">
                        <h3 class="card-title text-center mb-5" style="color: white;">Form Edit Profil</h5>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> Terjadi Kesalahan saat input data<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif


                        <form class="row g-3" method="POST" action="{{ route('myprofil.update',$row->id)}}"
                            enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-6">
                            <label for="inputNane4" class="form-label" style="color: white;">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $row->email }}" placeholder="email@gmail.com" disabled>
                        </div>

                        <div class="col-6">
                            <label for="inputNane4" class="form-label" style="color: white;">Nama Lengkap</label>
                            <input type="text" class="form-control" name="name" value="{{ $row->name }}" placeholder="name">
                        </div>
                        
                        <div class="col-6">
                            <label for="inputNane4" class="form-label" style="color: white;">Password</label>
                            <input type="password" class="form-control" name="password"  placeholder="password">
                        </div>

                        <div class="col-6">
                            <label for="inputNane4" class="form-label" style="color: white;">No HP</label>
                            <input type="number" class="form-control" name="no_hp" value="{{ $row->no_hp }}" placeholder="no_hp">
                        </div>

                        
                        <div class="col-6">
                            <label class="form-label" style="color: white;">Role</label>
                            <div class="col-sm-12">
                                <select class="form-select" name="role" disabled>
                                    <option selected style="color: black;" >-- Pilih Role --</option>
                                    @foreach($ar_role as $role)
                                    @php $sel = ($role == $row->role) ? 'selected' : ''; @endphp
                                    <option value="{{ $role }}" {{ $sel }} style="color: black;" >{{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="inputNane4" class="form-label" style="color: white;">Alamat</label>
                            <textarea class="form-control" name="alamat" style="height: 100px">{{ $row->alamat }}</textarea>
                        </div>
                        
                        <div class="col-6">
                            <label for="inputNane4" class="form-label" style="color: white;">Foto</label>
                            <input class="form-control" type="file" name="foto" placeholder="foto">
                                @if(!empty($row->foto)) <img src="{{ url('assets/img/user')}}/{{$row->foto}}" 
                                                            width="10%" class="img-thumbnail">
                                <br/>{{$row->foto}}
                                @endif
                        </div>

                        <div class="text-center mt-5 mb-5" style="border-radius: 130px;">
                            <button type="submit" class="btn btn-success" style="margin-right: 10px;">Simpan</button>
                            <button type="reset" class="btn btn-dark" style="margin-right: 10px;">Batal</button>
                        </div>
                        
                    </form><!-- Vertical Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
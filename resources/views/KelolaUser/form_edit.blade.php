@extends('Admin.home')
@section('content')
@php
$ar_role = ['Admin','Kasir','Customer'];
@endphp
@if(Auth::user()->role == 'Admin')
<section class="section mb-5">
    <h2 class="mt-3 ms-3 text-primary fw-bold">Dashboard</h2>
    <nav>
        <ol class="breadcrumb mb-4 ms-3">
            <li class="breadcrumb-item"><a href="{{ url('kelola_user') }}" class="text-decoration-none text-primary">Kelola User</a></li>
            <li class="breadcrumb-item active text-secondary">Form Update Kelola User</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card-footer shadow-lg border-0 rounded-4 padding-card mb-5">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center rounded-top">
                    <h5 class="mb-0 fw-bold">Form Update Kelola User</h5>
                    <a href="{{ url('kelola_user') }}" class="btn btn-light btn-sm fw-bold">
                        <i class="fa fa-arrow-circle-left"></i> Back
                    </a>
                </div>
                <div class="card-body bg-light">
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
                    <form class="row g-4" method="POST" action="{{ route('kelola_user.update',$row->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- User Email -->
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" id="email" class="form-control" name="email" value="{{ $row->email }}" placeholder="email@gmail.com" disabled>
                        </div>

                        <!-- Full Name -->
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" id="name" class="form-control" name="name" value="{{ $row->name }}" placeholder="Nama Lengkap">
                        </div>

                        <!-- Password -->
                        <div class="col-md-6">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <input type="password" id="password" class="form-control" name="password" placeholder="Password">
                        </div>

                        <!-- Phone Number -->
                        <div class="col-md-6">
                            <label for="no_hp" class="form-label fw-bold">No HP</label>
                            <input type="number" id="no_hp" class="form-control" name="no_hp" value="{{ $row->no_hp }}" placeholder="No HP">
                        </div>

                        <!-- Is Active -->
                        <div class="col-md-6">
                            <label for="isactive" class="form-label fw-bold">IsActive (isi 0 atau 1)</label>
                            <input type="number" id="isactive" class="form-control" name="isactive" value="{{ $row->isactive }}" placeholder="IsActive">
                        </div>

                        <!-- Role -->
                        <div class="col-md-6">
                            <label for="role" class="form-label fw-bold">Role</label>
                            <select id="role" class="form-select" name="role">
                                <option value="">-- Pilih Role --</option>
                                @foreach($ar_role as $role)
                                    @php $sel = ($role == $row->role) ? 'selected' : ''; @endphp
                                    <option value="{{ $role }}" {{ $sel }}>{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Address -->
                        <div class="col-md-6">
                            <label for="alamat" class="form-label fw-bold">Alamat</label>
                            <textarea id="alamat" class="form-control" name="alamat" style="height: 100px">{{ $row->alamat }}</textarea>
                        </div>

                        <!-- Photo -->
                        <div class="col-md-6">
                            <label for="foto" class="form-label fw-bold">Foto</label>
                            <input type="file" id="foto" class="form-control" name="foto">
                            @if(!empty($row->foto)) 
                                <img src="{{ url('assets/img/user')}}/{{$row->foto}}" width="10%" class="img-thumbnail">
                                <br/>{{$row->foto}}
                            @endif
                        </div>

                        <!-- Submit and Reset Buttons -->
                        <div class="col-12 d-flex justify-content-end mt-4 ">
                            <button type="submit" class="btn btn-success btn-lg px-4 me-2 shadow-sm">Simpan</button>
                            <button type="reset" class="btn btn-dark btn-lg px-4 shadow-sm">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@else
    @include('Admin.access_denied')
@endif
@endsection
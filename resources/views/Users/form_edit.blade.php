@extends('Admin.home')
@section('content')
@php
$ar_role = ['Admin','Kasir','Customer'];
@endphp
<section class="section">
    <h2 style="margin: 10px 0px 10px 10px; ">Dashboard</h2>
        <nav>
            <ol class="breadcrumb mb-4 " style="margin-left: 10px;">
                <li class="breadcrumb-item"><a style="text-decoration: none; color: black;" href="{{ url('users') }}">Users</a></li>
                <li class="breadcrumb-item active">Form Update Users</li>
            </ol>
        </nav>
    <div class="row">
        <div class="col-lg-12">
            
            <div class="card">
            <div class="mt-4" style="width:550px; margin-left:18px;">
                    <a class="btn btn-warning btn-sm fw-bold" title="Kembali" 
                        href=" {{ url('users') }}">
                        <i class="fa fa-arrow-circle-left"></i> Back
                    </a>
                </div>
                
                <div class="card-body">
                    <h5 class="card-title text-center mb-5">Form Update Users</h5>

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
                    <form class="row g-3" method="POST" action="{{ route('users.update',$row->id)}}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-6">
                            <label for="inputNane4" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $row->email }}" placeholder="email@gmail.com" disabled>
                        </div>
                        <div class="col-6">
                            <label for="inputNane4" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" value="{{ $row->username }}" placeholder="username">
                        </div>
                        <div class="col-6">
                            <label for="inputNane4" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" value="{{ $row->password }}" placeholder="password">
                        </div>
                        <div class="col-6">
                            <label for="inputNane4" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="namaLengkap" value="{{ $row->namaLengkap }}" placeholder="Nama Lengkap">
                        </div>
                        <div class="col-6">
                            <label for="inputNane4" class="form-label">No HP</label>
                            <input type="number" class="form-control" name="noHP" value="{{ $row->noHP }}" placeholder="noHP">
                        </div>

                        <div class="col-6">
                            <label class="form-label">Role</label>
                            <div class="col-sm-12">
                                <select class="form-select" name="role">
                                    <option selected>-- Pilih Role --</option>
                                    @foreach($ar_role as $role)
                                    @php $sel = ($role == $row->role) ? 'selected' : ''; @endphp
                                    <option value="{{ $role }}" {{ $sel }}>{{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="inputNane4" class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" style="height: 100px">{{ $row->alamat }}</textarea>
                        </div>
                        
                        <div class="col-6">
                            <label for="inputNane4" class="form-label">Foto</label>
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
</section>

@endsection
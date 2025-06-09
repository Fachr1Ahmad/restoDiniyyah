@extends('Admin.home')
@section('content')
@php
$ar_status = ['Ready','Waiting List','Sold Out'];
$ar_kategori = App\Models\Kategori::all();
@endphp
<section class="section">
    <h2 class="mt-3 ms-3 text-primary fw-bold">Dashboard</h2>
    <nav>
        <ol class="breadcrumb mb-4 ms-3">
            <li class="breadcrumb-item"><a href="{{ url('menu') }}" class="text-decoration-none text-primary">Menu</a></li>
            <li class="breadcrumb-item active text-secondary">Form Update Menu</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card-footer shadow-lg border-0 rounded-4 padding-card">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center rounded-top">
                    <h5 class="mb-0 fw-bold">Form Update Menu</h5>
                    <a href="{{ url('menu') }}" class="btn btn-light btn-sm fw-bold">
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
                    <form class="row g-4" method="POST" action="{{ route('menu.update',$row->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Nama Menu -->
                        <div class="col-md-6">
                            <label for="namaMenu" class="form-label fw-bold">Nama Menu</label>
                            <input type="text" id="namaMenu" class="form-control @error('namaMenu') is-invalid @enderror" 
                                name="namaMenu" placeholder="Nama Menu" value="{{ old('namaMenu', $row->namaMenu) }}">
                            @error('namaMenu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label for="status" class="form-label fw-bold">Status</label>
                            <select id="status" class="form-select @error('status') is-invalid @enderror" name="status">
                                <option value="">-- Pilih Status --</option>
                                @foreach($ar_status as $sts)
                                    <option value="{{ $sts }}" {{ old('status', $row->status) == $sts ? 'selected' : '' }}>{{ $sts }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Harga -->
                        <div class="col-md-6">
                            <label for="harga" class="form-label fw-bold">Harga</label>
                            <input type="number" id="harga" class="form-control @error('harga') is-invalid @enderror" 
                                name="harga" placeholder="Harga" value="{{ old('harga', $row->harga) }}">
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Stok -->
                        <div class="col-md-6">
                            <label for="stok" class="form-label fw-bold">Stok</label>
                            <input type="number" id="stok" class="form-control @error('stok') is-invalid @enderror" 
                                name="stok" placeholder="Stok" value="{{ old('stok', $row->stok) }}">
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Foto -->
                        <div class="col-md-6">
                            <label for="foto" class="form-label fw-bold">Foto</label>
                            <input type="file" id="foto" class="form-control" name="foto">
                            @if(!empty($row->foto)) 
                                <img src="{{ url('assets/img/menu')}}/{{$row->foto}}" width="10%" class="img-thumbnail">
                                <br/>{{$row->foto}}
                            @endif
                        </div>

                        <!-- Kategori -->
                        <div class="col-md-6">
                            <label for="kategori_id" class="form-label fw-bold">Kategori</label>
                            <select id="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" name="kategori_id">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($ar_kategori as $ktg)
                                    <option value="{{ $ktg->id }}" {{ old('kategori_id', $row->kategori_id) == $ktg->id ? 'selected' : '' }}>
                                        {{ $ktg->namaKategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol Simpan dan Batal -->
                        <div class="col-12 d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-success btn-lg px-4 me-2 shadow-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

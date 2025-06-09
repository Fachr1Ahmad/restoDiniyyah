@extends('Admin.home')
@section('content')
<section class="section">
    <h2 class="mt-3 ms-3 text-primary fw-bold">Dashboard</h2>
    <nav>
        <ol class="breadcrumb mb-4 ms-3">
            <li class="breadcrumb-item"><a href="{{ url('menu') }}" class="text-decoration-none text-primary">Menu</a></li>
            <li class="breadcrumb-item active text-secondary">Form Input Menu</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card-footer shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center rounded-top">
                    <h5 class="mb-0 fw-bold">Form Input Menu</h5>
                    <a href="{{ url('menu') }}" class="btn btn-light btn-sm fw-bold">
                        <i class="fa fa-arrow-circle-left"></i> Back
                    </a>
                </div>
                <div class="card-body bg-light">
                    <form class="row g-4" method="POST" action="{{ route('menu.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <label for="namaMenu" class="form-label fw-bold">Nama Menu</label>
                            <input type="text" id="namaMenu" class="form-control @error('namaMenu') is-invalid @enderror" 
                                name="namaMenu" placeholder="Nama Menu" value="{{ old('namaMenu') }}">
                            @error('namaMenu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label fw-bold">Status</label>
                            <select id="status" class="form-select @error('status') is-invalid @enderror" name="status">
                                <option value="">-- Pilih Status --</option>
                                @foreach($ar_status as $sts)
                                    <option value="{{ $sts }}" {{ old('status') == $sts ? 'selected' : '' }}>{{ $sts }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="harga" class="form-label fw-bold">Harga</label>
                            <input type="number" id="harga" class="form-control @error('harga') is-invalid @enderror" 
                                name="harga" placeholder="Harga" value="{{ old('harga') }}">
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="stok" class="form-label fw-bold">Stok</label>
                            <input type="number" id="stok" class="form-control @error('stok') is-invalid @enderror" 
                                name="stok" placeholder="Stok" value="{{ old('stok') }}">
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="inputNane4" class="form-label">Foto</label>
                            <input class="form-control" type="file" name="foto" placeholder="foto">
                        </div>
                        <div class="col-md-6">
                            <label for="kategori_id" class="form-label fw-bold">Kategori</label>
                            <select id="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" name="kategori_id">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($ar_kategori as $ktg)
                                    <option value="{{ $ktg->id }}" {{ old('kategori_id') == $ktg->id ? 'selected' : '' }}>
                                        {{ $ktg->namaKategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-success btn-lg px-4 me-2 shadow-sm">Simpan</button>
                            <button type="reset" class="btn btn-secondary btn-lg px-4 shadow-sm">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

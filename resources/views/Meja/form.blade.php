@extends('Admin.home')
@section('content')
<section class="section">
    <h2 class="mt-3 ms-3 text-primary fw-bold">Dashboard</h2>
    <nav>
        <ol class="breadcrumb mb-4 ms-3">
            <li class="breadcrumb-item"><a href="{{ url('meja') }}" class="text-decoration-none text-primary">Meja</a></li>
            <li class="breadcrumb-item active text-secondary">Form Input Meja</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card-footer shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center rounded-top">
                    <h5 class="mb-0 fw-bold">Form Input Meja</h5>
                    <a href="{{ url('meja') }}" class="btn btn-light btn-sm fw-bold">
                        <i class="fa fa-arrow-circle-left"></i> Back
                    </a>
                </div>
                <div class="card-body bg-light">
                    <form class="row g-4" method="POST" action="{{ route('meja.store') }}">
                        @csrf
                        <div class="col-md-6">
                            <label for="kodeMeja" class="form-label fw-bold">Kode Meja</label>
                            <input type="text" id="kodeMeja" class="form-control @error('kodeMeja') is-invalid @enderror" 
                                name="kodeMeja" placeholder="Kode Meja" value="{{ old('kodeMeja') }}">
                            @error('kodeMeja')
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
@extends('Admin.home')
@section('content')


<section class="section">
    <h2 class="mt-3 ms-3 text-primary fw-bold">Dashboard</h2>
    <nav>
        <ol class="breadcrumb mb-4 ms-3">
            <li class="breadcrumb-item"><a href="{{ url('pembayaran') }}" class="text-decoration-none text-primary">Pembayaran</a></li>
            <li class="breadcrumb-item active text-secondary">Form Update Pembayaran</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card-footer shadow-lg border-0 rounded-4 padding-card">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center rounded-top">
                    <h5 class="mb-0 fw-bold">Form Update Pembayaran</h5>
                    <a href="{{ url('pembayaran') }}" class="btn btn-light btn-sm fw-bold">
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
                    <form class="row g-4" method="POST" action="{{ route('pembayaran.update', $row->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <label class="form-label fw-bold">User ID</label>
                            <input type="text" name="user_id" readonly value="{{ $row->pesanan->user->name }}" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Metode Pembayaran</label>
                            <input type="hidden" name="metodePembayaran_id" readonly value="{{ $row->metodePembayaran->id }}">
                            <input type="text" readonly value="{{ $row->metodePembayaran->metodePembayaran }}" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Kode Pesanan</label>
                            <input type="hidden" name="pesanan_id" readonly value="{{ $row->pesanan->id }}">
                            <input type="text" readonly value="{{ $row->pesanan->order_id }}" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Status Pembayaran</label>
                            <select class="form-select" name="statusPembayaran">
                                <option selected disabled>-- Pilih Status Pembayaran --</option>
                                <option value="Konfirmasi">Konfirmasi</option>
                                <option value="Tolak">Tolak</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Bukti Pembayaran</label>
                            <input class="form-control" type="file" name="buktiPembayaran" placeholder="Bukti Pembayaran">
                            @if(!empty($row->buktiPembayaran))
                            <img src="{{ url('assets/img/bukti')}}/{{$row->buktiPembayaran}}" width="10%" class="img-thumbnail">
                            <br/>{{$row->buktiPembayaran}}
                            @endif
                        </div>

                        <div class="col-12 d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-success btn-lg px-4 me-2 shadow-sm">Simpan</button>
                            <button type="reset" class="btn btn-dark btn-lg px-4 shadow-sm">Batal</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
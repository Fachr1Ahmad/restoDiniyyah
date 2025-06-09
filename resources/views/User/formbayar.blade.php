@extends('User.ipesan')
@section('content')
@if(Auth::user()->role == 'Customer')
<div class="container-fluid p-0 mb-5 page-header" style="height: 400px; display: flex; align-items: center; justify-content: center;">
    <div class="text-center">
	    <h3 class="display-4 mb-0 mt-lg-5 text-light font-weight-bold" style="font-size: 3rem;">Pembayaran</h3>
        <div class="d-inline-flex mb-lg-5">
			<p class="m-0 text-secondary font-weight-bold"><a class="text-secondary font-weight-bold m-0" href="/Home">Home</a></p>
            <p class="m-0 text-secondary font-weight-bold px-2">/</p>
            <p class="m-0 text-secondary font-weight-bold"><a class="text-secondary font-weight-bold m-0">Pembayaran</a></p>
		</div>
    </div>
</div>
<!-- Page Header End -->

<!-- Reservation Start -->
<div class="container-fluid py-5 mt-3">
    <div class="container">
        <div class="reservation position-relative">
            <div class="row align-items-center">
                <div class="col-lg-6 my-5 my-lg-0">
                    <div class="card p-5 shadow-lg rounded bg-light" >
                        <div class="mb-4 text-center">
                            <h3 class="display-5 text-primary fw-bold">Konfirmasi Pembayaran Anda</h3>
                        </div>
                        <div class="mb-4 text-center">
                            <h5 class="text-primary">Total Pembayaran</h5>
                            <h3 class="display-5 text-primary fw-bold">Rp. {{ number_format($row->total_harga, 0, ',', '.') }}</h3>
                        </div>
                        <p class="text-primary text-center">Terima kasih telah memilih <b>Resto Diniyyah</b>. Unggah bukti pembayaran untuk melanjutkan pesanan, atau kunjungi kasir jika membayar dengan <b>cash</b>.</p>
                    </div>
                </div>

                <div class="card-body col-lg-6 my-5 my-lg-0">
                    <h3 class="card-title text-center mb-5" style="color: white;">Form Pembayaran</h3>
                        <form class="row g-3" method="POST" action="{{ route('bayar.store')}}"
                            enctype="multipart/form-data">
                            @csrf
                    
                            <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="pesanan_id" value="{{ $row->id }}">
                    
                            <div class="col-6">
                                <div class="col-sm-12">
                                    <label for="inputNane4" class="form-label" style="color: white;">Nama User</label>
                                    <input type="text" class="form-control" readonly value="{{ Auth::user()->name }}">
                                </div>
                            </div>
                    
                            <div class="col-6">
                                <label class="form-label" style="color: white;"> Kode Pesanan </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" readonly value="{{ $row->id }}">
                                </div>
                            </div>

                            <div class="col-6">
                                <label class="form-label" style="color: white;">Metode Pembayaran</label>
                                <div class="col-sm-12">
                                    <select class="form-select form-control @error('metodePembayaran') 
                                        is-invalid @enderror" name="metodePembayaran">
                                        <option value="" style="color: black;">-- Pilih Metode Bayar --</option>
                                        @foreach($mp as $metode_pembayaran)
                                        <option value="{{ $metode_pembayaran->id }}"
                                            style="color: black;">{{ $metode_pembayaran->metodePembayaran }}</option>
                                        @endforeach
                                    </select>
                                    @error('metodePembayaran')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="inputNane4" class="form-label" style="color: white;">Bukti
                                    Pembayaran</label>
                                <input class="form-control" type="file" name="buktiPembayaran"
                                    placeholder="Bukti Pembayaran">
                            </div>

                            <div class="text-center mt-5 mb-5" style="border-radius: 130px;">
                                <button type="submit" class="btn btn-success"
                                    style="margin-right: 10px;">Simpan</button>
                                <button type="reset" class="btn btn-dark" style="margin-right: 10px;">Batal</button>
                            </div>

                        </form><!-- Vertical Form -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Reservation End -->
@else
@include('User.access_denied')
@endif
@endsection
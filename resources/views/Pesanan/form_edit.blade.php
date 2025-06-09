@extends('Admin.home')
@section('content')
@php
    $ar_users = App\Models\Userss::all();
    $ar_meja = App\Models\Meja::all();
    $ar_menu = App\Models\Menu::all();
    $ar_pembayaran = App\Models\Pembayaran::all();
    $ar_status = ['Pesanan Sedang Di Proses','Pesanan Siap Di Hidangkan'];
@endphp
<section class="section">
    <h2 style="margin: 10px 0px 10px 10px; ">Dashboard</h2>
        <nav>
            <ol class="breadcrumb mb-4 " style="margin-left: 10px;">
                <li class="breadcrumb-item"><a style="text-decoration: none; color: black;" href="{{ url('pesanan') }}">Pesanan</a></li>
                <li class="breadcrumb-item active">Form Update Pesanan</li>
            </ol>
        </nav>
    <div class="row">
        <div class="col-lg-12">
            
            <div class="card">
                <div class="mt-4" style="width:550px; margin-left:18px;">
                    <a class="btn btn-warning btn-sm fw-bold" title="Kembali" 
                        href=" {{ url('pesanan') }}">
                        <i class="fa fa-arrow-circle-left"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center mb-5">Form Input Pesanan</h5>

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
                    <form class="row g-3" method="POST" action="{{ route('pesanan.update',$row->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="col-6">
                            <label for="inputNane4" class="form-label">Kode Pesanan</label>
                            <input type="text" class="form-control" name="kodePesanan" value="{{ $row->kodePesanan }}" placeholder="Kode Pesanan" disabled>
                        </div>

                        <div class="col-6">
                            <label class="form-label">Nama Menu</label>
                            <div class="col-sm-12">
                                <select class="form-select" name="menu_id">
                                    <option selected>-- Pilih Menu --</option>
                                    @foreach($ar_menu as $menu)
                                    @php $sel = ($menu->id == $row->menu_id) ? 'selected' : ''; @endphp
                                    <option value="{{ $menu->id }}" {{ $sel }}>{{ $menu->namaMenu }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="inputNane4" class="form-label">Waktu Pesan</label>
                            <input type="datetime-local" class="form-control" name="waktuPesan" value="{{ $row->waktuPesan }}" placeholder="Waktu Pesan">
                        </div>

                        <div class="col-6">
                            <label for="inputNane4" class="form-label">Total Pesan</label>
                            <input type="number" class="form-control" name="TotalPesan" value="{{ $row->TotalPesan }}" placeholder="Total Pesan">
                        </div>

                        <div class="col-6">
                            <label class="form-label">Nama User</label>
                            <div class="col-sm-12">
                                <select class="form-select" name="users_id">
                                    <option selected>-- Pilih User --</option>
                                    @foreach($ar_users as $user)
                                    @php $sel = ($user->id == $row->users_id) ? 'selected' : ''; @endphp
                                    <option value="{{ $user->id }}" {{ $sel }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="form-label">Kode Meja</label>
                            <div class="col-sm-12">
                                <select class="form-select" name="meja_id">
                                    <option selected>-- Pilih Kode Meja --</option>
                                    @foreach($ar_meja as $meja)
                                    @php $sel = ($meja->id == $row->meja_id) ? 'selected' : ''; @endphp
                                    <option value="{{ $meja->id }}" {{ $sel }}>{{ $meja->kodeMeja }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="form-label">Status Pesanan</label>
                            <div class="col-sm-12">
                                <select class="form-select" name="statusPesanan">
                                    <option selected>-- Pilih Status Pesanan --</option>
                                    @foreach($ar_status as $sts)
                                    @php $sel = ($sts == $row->statusPesanan) ? 'selected' : ''; @endphp
                                    <option value="{{ $sts }}" {{ $sel }}>{{ $sts }}</option>
                                    @endforeach
                                </select>
                            </div>
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
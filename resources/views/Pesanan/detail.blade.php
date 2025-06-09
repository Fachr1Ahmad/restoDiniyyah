@extends('Admin.home')
@section('content')
<section class="section profile">
    <h2 style="margin: 10px 0px 10px 10px; ">Dashboard</h2>
        <nav>
            <ol class="breadcrumb mb-4 " style="margin-left: 10px;">
                <li class="breadcrumb-item"><a style="text-decoration: none; color: black;" href="{{ url('pesanan') }}">Pesanan</a></li>
                <li class="breadcrumb-item active">Detail Pesanan</li>
            </ol>
        </nav>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
            <div class="mt-4" style="width:550px; margin-left:18px;">
                    <a class="btn btn-warning btn-sm fw-bold" title="Kembali" 
                        href=" {{ url('pesanan') }}">
                        <i class="fa fa-arrow-circle-left"></i> Back
                    </a>
                </div>
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    @empty($row->menu->foto)
                    <img src="{{ url('assets/img/menu/nophoto.png') }}" alt="Profile" width="150px">
                    @else
                    <img src="{{ url('assets/img/menu/'.$row->menu->foto) }}" alt="Profile" width="150px">
                    @endempty
                    <h3 style="margin-top: 10px;">Kode Pesanan : {{ $row->kodePesanan }}</h3>
                    <h4>Nama Pemesan : {{ $row->users->name }}</h4>
                    <h5>Waktu Pesan : {{ $row->waktuPesan }}</h5>
                </div>
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="alert alert-warning d-flex flex-column align-items-center" style="width:300px; ">
                        Total Pesan : {{ $row->TotalPesan }}
                        <br/>Total Harga : {{ $row->TotalHarga }}
                        <br/>Kode Meja : {{ $row->meja->kodeMeja }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>



@endsection
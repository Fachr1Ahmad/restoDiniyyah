@extends('Admin.home')
@section('content')
<section class="section profile">
    <h2 style="margin: 10px 0px 10px 10px; ">Dashboard</h2>
        <nav>
            <ol class="breadcrumb mb-4 " style="margin-left: 10px;">
                <li class="breadcrumb-item"><a style="text-decoration: none; color: black;" href="{{ url('kategori') }}">Kategori</a></li>
                <li class="breadcrumb-item active">Detail Kategori</li>
            </ol>
        </nav>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="mt-4" style="width:550px; margin-left:18px;">
                    <a class="btn btn-warning btn-sm fw-bold" title="Kembali" 
                        href=" {{ url('kategori') }}">
                        <i class="fa fa-arrow-circle-left"></i> Back
                    </a>
                </div>

                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <h2>Nama Kategori :</h2>
                    <h3>{{ $row->namaKategori }}</h3>
                </div>

            </div>
        </div>
    </div>
</section>



@endsection
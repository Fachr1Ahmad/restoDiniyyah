@extends('User.imenu')

@section('content')
<div class="container-fluid page-header mb-5 position-relative">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Pesan Menu</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="/Home">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white"><a class="text-white" href="/pesanmenu">Pesan Menu</a></p>
            </div>
        </div>
</div>
    
<div class="mb-4">
        <div style="background-color: thistle; border-radius: 20px; padding: 20px;">
            <h1 class="display-4" style="color: red; font-weight: bold;">Access Denied</h1>
            <p class="lead" style="color: black; font-weight: bold;">Maaf Anda Terlarang Akses Halaman Ini</p>
            <hr class="my-4">
            <p style="color: black; font-size: 16px;">Karena Mungkin Anda Belum Login atau Anda Sudah Login Tapi Bukan Role Yang di Izinkan</p>
            
        </div>
</div>
@endsection
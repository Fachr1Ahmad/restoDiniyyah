@extends('Admin.home')
@section('content')
<div class="mb-4">
    <h2 style="margin: 10px 0px 10px 10px; ">Administrator</h2>
        <nav>
            <ol class="breadcrumb mb-4 " style="margin-left: 10px;">
                <li class="breadcrumb-item"><a style="text-decoration: none; color: black;" href="{{ url('kelola_user') }}">Users</a></li>
                <li class="breadcrumb-item active">Kelola User</li>
            </ol>
        </nav>
        
        <div style="background-color: thistle; border-radius: 20px; padding: 20px;">
            <h1 class="display-4" style="color: red; font-weight: bold;">Access Denied</h1>
            <p class="lead" style="color: black; font-weight: bold;">Maaf Anda Terlarang Akses Halaman Ini</p>
            <hr class="my-4">
            <p style="color: black; font-size: 16px;">Karena Mungkin Anda Belum Login atau Anda Sudah Login Tapi Bukan Role Yang di Izinkan</p>
            
        </div>
</div>
@endsection
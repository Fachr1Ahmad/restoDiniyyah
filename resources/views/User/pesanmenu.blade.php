@extends('User.ipesan')
@section('content')
@if(Auth::user()->role == 'Customer')
<!-- Page Header Start -->
<div class="container-fluid p-0 mb-5 page-header" style="height: 400px; display: flex; align-items: center; justify-content: center;">
    <div class="text-center">
	    <h3 class="display-4 mb-0 mt-lg-5 text-light font-weight-bold" style="font-size: 3rem;">Pesan Menu</h3>
        <div class="d-inline-flex mb-lg-5">
			<p class="m-0 text-secondary font-weight-bold"><a class="text-secondary font-weight-bold m-0" href="/Home">Home</a></p>
            <p class="m-0 text-secondary font-weight-bold px-2">/</p>
            <p class="m-0 text-secondary font-weight-bold"><a class="text-secondary font-weight-bold m-0" href="{{ url('/create') }}">Pesan Menu</a></p>
		</div>
    </div>
</div>
<!-- Page Header End -->

<div class="container">
    <div class="row">
        <div class="col-8">
            @foreach($kategori as $kat)
            @if (sizeof($kat->menu) > 1)
            <h2 class="mt-4">{{ $kat->namaKategori }}</h2>
            @endif
            <div class="row">
                @foreach($kat->menu as $menu)
                <div class="col-md-4 mb-4">
                    @livewire('product', ['menu' => $menu], key($menu->id))
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
        <div class="col mt-4">
            @livewire('cart', ['user_id' => Auth::id()])
        </div>
    </div>
</div>
<!-- Reservation End -->
@else
@include('User.access_denied')
@endif
@endsection
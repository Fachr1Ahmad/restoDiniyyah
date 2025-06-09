@extends('User.ipesananpelanggan')
@section('content')
@include('sweetalert::alert')
<!-- Checkout Start -->
<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-5 text-primary text-center ftco-animate">
				<h2 class="">Kelola Pesanan</h2>
			</div>
		</div>
	</div>
</section>

@if (session()->has('message'))
<div class="col-12">
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		{{ session('message') }}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
</div>
@endif

@if (session()->has('error'))
<div class="col-12">
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		{{ session('error') }}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
	</div>
</div>
@endif

<section class="ftco-section">
	<div class="container" style="margin-top: -100px;">
		<div class="row">
			<div class="col-md-12 ftco-animate" wire:poll.keep-alive>
				@livewire('pesanan')
			</div>
		</div>
	</div>
</section>
@endsection
@include('User.header')
<!-- Page Header -->
<div class="container-fluid page-header mb-5 position-relative">
	<div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
		<h3 class="display-4 mb-0 mt-lg-5 text-light font-weight-bold" style="font-size: 3rem;">Metode Pembayaran</h3>
		<div class="d-inline-flex mb-lg-5">
			<p class="m-0 text-secondary font-weight-bold"><a class="m-0 text-secondary font-weight-bold" href="{{ url('/') }}">Home</a></p>
			<p class="m-0 text-secondary font-weight-bold px-2">/</p>
			<p class="m-0 text-secondary font-weight-bold"><a class="m-0 text-secondary font-weight-bold" href="{{ url('/cart') }}">Pesanan</a></p>
			<p class="m-0 text-secondary font-weight-bold px-2">/</p>
			<p class="m-0 text-secondary font-weight-bold"><a class="m-0 text-secondary font-weight-bold" href="{{ url('/metode-pembayaran') }}">Metode Pembayaran</a></p>
		</div>
	</div>
</div>
<!-- Page Header End -->
@yield('content')
@include('User.twofooter')
@extends('User.itestimoni')
@section('content')

  <!-- Page Header Start -->
  <div class="container-fluid p-0 mb-5 page-header" style="height: 400px; display: flex; align-items: center; justify-content: center;">
	<div class="text-center">
		<h3 class="display-3 text-light m-0 font-weight-bold" style="font-size: 3rem;">About</h3>
    <div class="d-inline-flex mb-lg-5">
      <p class="m-0 text-secondary	font-weight-bold"><a class="text-secondary	font-weight-bold m-0" href="/Home">Home</a></p>
      <p class="m-0 text-secondary	font-weight-bold px-2">/</p>
      <p class="m-0 text-secondary	font-weight-bold"><a class="text-secondary	font-weight-bold m-0" href="/about">About</a></p>
    </div>
	</div>
</div>
  <!-- Page Header End -->

  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container">

      <div class="row">
        <div class="col-lg-6">
          <img src="{{ asset('assets/img/about.jpg') }}" class="img-fluid rounded shadow" alt="About Image">
        </div>
        <div class="col-lg-6 pt-4 pt-lg-0 content">
          <h3 class="text-dark">Restoran Diniyyah Puteri</h3>
          <p class="text-muted">Padang Panjang, Sumatera Barat</p>
          <p class="fst-italic text-dark">
            Kami menyediakan berbagai menu makanan dan minuman yang lezat dan berkualitas tinggi. Dengan pengalaman bertahun-tahun dalam industri kuliner, kami berkomitmen untuk memberikan pelayanan terbaik kepada pelanggan kami.
          </p>
          <div class="ms-3">
            <p> <i class="bi bi-check-circle text-dark"></i> Pilihan menu yang beragam dan menarik </p>
            <p> <i class="bi bi-check-circle text-dark"></i> Proses pemesanan yang cepat dan mudah </p>
            <p> <i class="bi bi-check-circle text-dark"></i> Harga terjangkau dengan kualitas terbaik </p>
          </div>
        
          <p class="text-muted">
            Nikmati makanan dan minuman favorit Anda di Restoran Diniyyah Puteri. Kami siap melayani Anda dengan sepenuh hati dan memberikan pengalaman kuliner yang tak terlupakan.
          </p>
          <p class="text-muted">Pesan sekarang dan rasakan pengalaman terbaik bersama kami!</p>
        </div>
      </div>

    </div>
  </section><!-- End About Section -->

  
@endsection

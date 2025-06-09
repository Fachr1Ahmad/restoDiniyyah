@include('User.header')
@include('sweetalert::alert')
{{-- Bagian Hero Section --}}
<div class="container-fluid page-header p-0 mb-4" style="height: 400px; display: flex; align-items: center; justify-content: center;">
	<div class="text-center text-light bg-overlay">
        <h4 class="display-3 text-light m-0 font-weight-bold" style="font-size: 3rem;">Resto Diniyyah Puteri</h4>
        <p class="font-weight-medium m-0 text-secondary	font-weight-bold" style="font-size: 1.25rem;">Perguruan Diniyyah Puteri Padang Panjang</p>
    </div>
</div>

{{-- Bagian Our Story --}}
<section class="py-5 bg-light">
	<div class="container">
		<div class="text-center mb-5">
			<h1 class="fw-bold text-primary">About Us</h1>
		</div>
		<div class="row row-cols-1 row-cols-md-4 g-4">
			<div class="col">
				<div class="card p-4 bg-white rounded shadow-sm text-center">
					<h3 class="mb-4 text-primary fw-bold">Our Story</h3>
					<p><b>Kami hadir untuk menghadirkan pengalaman kuliner berkualitas tinggi, menggabungkan cita rasa yang menggugah dengan nilai-nilai pendidikan yang kami junjung.</b></p>
					<div class="mt-4">
						<i class="flaticon-choices display-4 text-primary"></i>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card p-4 bg-white rounded shadow-sm text-center">
					<h3 class="mb-4 text-primary fw-bold">Quality Ingredients</h3>
					<p><b>Hanya bahan-bahan pilihan terbaik yang kami gunakan, untuk memastikan setiap hidangan yang kami sajikan penuh dengan rasa yang luar biasa.</b></p>
					<div class="mt-4">
						<i class="flaticon-coffee-bean display-4 text-primary"></i>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card p-4 bg-white rounded shadow-sm text-center">
					<h3 class="mb-4 text-primary fw-bold">Our Dishes</h3>
					<p><b>Setiap hidangan kami disiapkan dengan penuh dedikasi, membawa rasa yang memuaskan di setiap suapan, menciptakan pengalaman makan yang tak terlupakan.</b></p>
					<div class="mt-4">
						<i class="flaticon-coffee-cup display-4 text-primary"></i>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card p-4 bg-white rounded shadow-sm text-center">
					<h3 class="mb-4 text-primary fw-bold">Fast Delivery</h3>
					<p><b>Nikmati kenyamanan layanan pengiriman cepat kami, dengan hidangan yang selalu sampai dalam keadaan segar dan siap dinikmati.</b></p>
					<div class="mt-4">
						<i class="flaticon-delivery-truck display-4 text-primary"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


{{-- Bagian Menu --}}
<div class="menu-container py-5 ">
    <section class="ftco-menu mb-4 pb-4">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading text-uppercase text-secondary">Explore</span>
                    <h2 class="mb-4 display-7 text-light font-weight-bold">Our Menu</h2>
                    <p class="text-light">Nikmati beragam hidangan lezat dari menu kami, yang disiapkan untuk memberikan pengalaman makan yang tak terlupakan.</p>
                </div>
            </div>
            <div class="row d-md-flex">
                <div class="col-lg-12 ftco-animate p-md-5">
                    <div class="row">
                        <div class="col-md-12 nav-link-wrap mb-4">
                            <div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                @foreach (['makanan' => 'Makanan', 'minuman' => 'Minuman', 'dessert' => 'Dessert', 'snack' => 'Snack'] as $key => $label)
                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="v-pills-{{ $loop->index }}-tab" data-bs-toggle="pill" href="#v-pills-{{ $loop->index }}" role="tab" aria-controls="v-pills-{{ $loop->index }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        <i class="fas fa-utensils"></i> {{ $label }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        @php
                            function rupiah($angka) {
                                return "Rp " . number_format($angka, 2, ',', '.');
                            }
                        @endphp
                        <div class="col-md-12 menu-item-container">
                            <div class="tab-content ftco-animate" id="v-pills-tabContent">
                                @foreach (['makanan' => 'Makanan', 'minuman' => 'Minuman', 'dessert' => 'Dessert', 'snack' => 'Snack'] as $key => $label)
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="v-pills-{{ $loop->index }}" role="tabpanel" aria-labelledby="v-pills-{{ $loop->index }}-tab">
                                        <div class="d-flex overflow-auto menu-item">
                                            @foreach ($$key as $row)
                                                <div class="card h-100 shadow-lg border-0 " style="min-width: 300px; margin-right: 15px;"> <!-- Menambahkan margin antar item -->
                                                    <div class="position-relative ">
                                                        @empty($row->foto)
                                                            <img src="{{ url('assets/img/menu/nophoto.png') }}" class="card-img-top" alt="Profile" style="height: 200px; object-fit: cover;">
                                                        @else
                                                            <img src="{{ url('assets/img/menu/'.$row->foto) }}" class="card-img-top" alt="Profile" style="height: 200px; object-fit: cover;">
                                                        @endempty
                                                        <div class="badge page-header position-absolute top-0 start-0 m-2 px-3 py-1 text-uppercase">{{ $row->status }}</div>
                                                    </div>
                                                    <div class="card-body text-center">
                                                        <h5 class="card-title text-primary fw-bold">{{ $row->namaMenu }}</h5>
                                                        <p class="card-text text-primary mb-2">{{ rupiah($row->harga) }}</p>
                                                        <a href="{{ route('cart.create') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4 py-2">Pesan Sekarang</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



{{-- Bagian Testimoni --}}
<div class="container-fluid py-5">
	<section class="py-5 bg-light">
		<div class="container">
			<div class="row justify-content-center mb-5">
				<div class="col-md-7 heading-section text-center ftco-animate">
					<span class="subheading text-uppercase text-primary mb-4 display-4 fw-bold">Testimoni</span>
					<p class="text-muted">Temukan pengalaman luar biasa dari pelanggan kami yang telah mencoba dan mencintai menu kami</p>
				</div>
			</div>
			<div class="owl-carousel menu-carousel testimonial-carousel">
			@foreach($testimoni as $row)
			<div class="testimonial-item">
				<div class="d-flex align-items-center mb-3">
					@empty($row->users->foto)
						<img src="{{ url('assets/img/user/nophoto.png') }}" width="100%" alt="Profile" style="border-radius: 5px;">
					@else
						<img src="{{ url('assets/img/user/'.$row->users->foto) }}" width="100%" alt="Profile" style="border-radius: 5px;">
					@endempty
					<div class="ml-3">
						<h4>{{$row->users->name}}</h4>
						<p>{{$row->users->role}}</p>
						<i>{{$row->date}}</i>
					</div>
				</div>
				<p>{{$row->pesan}}</p>
			</div>
			@endforeach
		</div>
	</section>
</div>
@include('User.twofooter')
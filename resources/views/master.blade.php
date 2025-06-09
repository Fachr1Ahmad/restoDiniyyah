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

@include('User.twofooter')
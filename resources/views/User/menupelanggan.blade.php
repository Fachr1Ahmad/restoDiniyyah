@extends('User.imenupelanggan')
@section('content')
    <!-- Page Header End -->
		<section class="ftco-section">
			<div class="container">
				<div class="row">
					<div class="col-md-6 mb-5 pb-3">
						<h3 class="mb-5 text-primary ftco-animate fw-bold">Makanan Utama</h3>
						@foreach($makanan as $row)
						<div class="pricing-entry d-flex ftco-animate">
								@empty($row->foto)
									<img src="{{ url('assets/img/menu/nophoto.png') }}" class="img" width="10%" alt="Profile" style="border-radius: 100%;">
								@else
									<img src="{{ url('assets/img/menu/'.$row->foto) }}" class="img" width="10%" alt="Profile" style="border-radius: 100%;">
								@endempty
								<div class="desc pl-3">
									<div class="d-flex text align-items-center" style="padding-bottom: 10px;">
										<h3><span>{{$row->namaMenu}}</span></h3>
										<span class="text-primary" style="padding-bottom: 20px;">Rp {{ number_format($row->harga, 2, ',', '.') }}</span>
									</div>
									<div class="d-block" style="margin-top: -20px;">
										<p>{{$row->status}}</p>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				
					<div class="col-md-6 mb-5 pb-3 ">
						<h3 class="mb-5 text-primary ftco-animate fw-bold">Minuman</h3>
							@php 
								$no = 1; 
							
								function rupiah($angka){
									$hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
									return $hasil_rupiah;
								}
							@endphp
							@foreach($minuman as $row)
							<div class="pricing-entry d-flex ftco-animate">
								@empty($row->foto)
									<img src="{{ url('assets/img/menu/nophoto.png') }}" class="img" width="10%" alt="Profile" style="border-radius: 100%;">
								@else
									<img src="{{ url('assets/img/menu/'.$row->foto) }}" class="img" width="10%" alt="Profile" style="border-radius: 100%;">
								@endempty
								<div class="desc pl-3">
									<div class="d-flex text align-items-center" style="padding-bottom: 10px;">
										<h3 clas><span>{{$row->namaMenu}}</span></h3>
										<span class="text-primary" style="padding-bottom: 20px;">{{ rupiah($row->harga) }}</span>
									</div>
									<div class="d-block" style="margin-top: -20px;">
										<p>{{$row->status}}</p>
									</div>
								</div>
							</div>
							@endforeach
					</div>

					<div class="col-md-6 mb-5 pb-3">
						<h3 class="mb-5 text-primary ftco-animate fw-bold">Dessert</h3>
						@foreach($dessert as $row)
						<div class="pricing-entry d-flex ftco-animate">
								@empty($row->foto)
									<img src="{{ url('assets/img/menu/nophoto.png') }}" class="img" width="10%" alt="Profile" style="border-radius: 100%;">
								@else
									<img src="{{ url('assets/img/menu/'.$row->foto) }}" class="img" width="10%" alt="Profile" style="border-radius: 100%;">
								@endempty
								<div class="desc pl-3">
									<div class="d-flex text align-items-center" style="padding-bottom: 10px;">
										<h3><span>{{$row->namaMenu}}</span></h3>
										<span class="text-primary" style="padding-bottom: 20px;">{{ rupiah($row->harga) }}</span>
									</div>
									<div class="d-block" style="margin-top: -20px;">
										<p>{{$row->status}}</p>
									</div>
								</div>
							</div>
						@endforeach
					</div>

					<div class="col-md-6 mb-5 pb-3">
						<h3 class="mb-5 text-primary ftco-animate fw-bold">Snack</h3>
						@foreach($snack as $row)
						<div class="pricing-entry d-flex ftco-animate">
								@empty($row->foto)
									<img src="{{ url('assets/img/menu/nophoto.png') }}" class="img" width="10%" alt="Profile" style="border-radius: 100%;">
								@else
									<img src="{{ url('assets/img/menu/'.$row->foto) }}" class="img" width="10%" alt="Profile" style="border-radius: 100%;">
								@endempty
								<div class="desc pl-3">
									<div class="d-flex text align-items-center" style="padding-bottom: 10px;">
										<h3><span>{{$row->namaMenu}}</span></h3>
										<span class="text-primary" style="padding-bottom: 20px;">{{ rupiah($row->harga) }}</span>
									</div>
									<div class="d-block" style="margin-top: -20px;">
										<p>{{$row->status}}</p>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</section>
    <!-- Menu End -->

    @endsection
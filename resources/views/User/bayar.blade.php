@extends('User.ibayar')
@section('content')


<!-- Checkout Start -->
<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-7 heading-section text-center ftco-animate">
				<h2 class="text-primary">History Pembayaran</h2>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section ftco-cart">
	<div class="container" style="margin-top: -100px;">
		<div class="row">
			<div class="col-md-12 ftco-animate">
				<div class="cart-list">
					<table class="table table-hover table-bordered table-striped align-middle">
						<thead class="table-dark">
							<tr class="text-center">
								<th>No</th>
								<th>Nama User</th>
								<th>Metode Pembayaran</th>
								<th>Total Harga</th>
								<th>Tanggal</th>
								<th>Kode Pesanan</th>
								<th>Bukti Pembayaran</th>
								<th>Status Pembayaran</th>
							</tr>
						</thead>
						<tbody>
							@if (Auth::user())
								@php
									$userId = Auth::id();
									$userPembayaran = $pembayaran->filter(function($row) use ($userId) {
										return optional($row->pesanan)->user_id == $userId;
									});
								@endphp
								@if($userPembayaran->count())
									@foreach($userPembayaran as $index => $row)
									<tr class="text-center">
										<td scope="row">{{ $loop->iteration }}</td>
										<td>
											{{ Auth::user()->name }}
										</td>
										<td>{{ $row->metodePembayaran->metodePembayaran }}</td>								
										<td>Rp {{ number_format($row->pesanan->total_harga, 0, ',', '.') }}</td>
										<td>{{ $row->updated_at->format('d M Y, H:i') }}</td>
										<td>{{ $row->pesanan->order_id }}</td>
										<td width="7%">
											@empty($row->buktiPembayaran)
											<img src="{{ url('assets/img/bukti/nophoto.png') }}" alt="No Photo"
												class="img-thumbnail" style="width: 60px; height: 60px;">
											@else
											<img src="{{ url('assets/img/bukti/'.$row->buktiPembayaran) }}" alt="Bukti Pembayaran"
												class="img-thumbnail" style="width: 60px; height: 60px;">
											@endempty
										</td>
										<td>
											<span class="badge 
												@switch($row->statusPembayaran)
													@case(Pembayaran::STATUS_CONFIRMED) bg-success @break
													@case(Pembayaran::STATUS_UNCONFIRMED) bg-warning text-dark @break
													@case(Pembayaran::STATUS_DENIED) bg-danger @break
													@default bg-info
												@endswitch
												rounded-pill px-2 py-1 text-uppercase shadow-sm"
												style="font-size: 0.7rem; letter-spacing: 0.2px; text-transform: capitalize; border: 1px solid rgba(0, 0, 0, 0.1);"
											>
												{{ ucfirst(strtolower($row->statusPembayaran)) }}
											</span>
										</td>
									</tr>
									@endforeach
								@else
									<tr>
										<td colspan="8" class="text-center text-muted py-4">
											<i class="bi bi-info-circle me-2"></i>
											Tidak ada data pembayaran untuk user ini.
										</td>
									</tr>
								@endif
							@else
								<tr>
									<td colspan="8" class="text-center">Silakan login untuk melihat data pembayaran.</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
	$('body').on('click', '.btnDelete', function(e) {
    e.preventDefault();
    var action = $(this).data('action');
    Swal.fire({
        title: 'Apakah Anda yakin ingin menghapus data ini?',
        text: "Data yang sudah dihapus tidak bisa dikembalikan lagi",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal',
        confirmButtonText: 'Yakin'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#formDelete').attr('action', action);
            $('#formDelete').submit();
        }
    })
})
</script>


<!-- Checkout End -->

@endsection
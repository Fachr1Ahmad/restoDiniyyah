@extends('User.imetodepembayaran')
@section('content')
<!-- Checkout Start -->
<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-7 heading-section text-center ftco-animate">
				<span class="subheading">Discover</span>
				<h2 class="">Metode Pembayaran</h2>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section ftco-cart">
	<div class="container" style="margin-top: -100px;">
		<div class="row">
			<div class="col-md-12 ftco-animate">
				<div class="cart-list">
					<table class="table">
						<thead class="table-dark">
							<tr class="text-center">
								<th>No</th>
								<th>&nbsp;</th>
								<th>Metode Pembayaran</th>
								<th>Nomer Akun</th>
							</tr>
						</thead>
						<tbody>
							<tr class="text-center">
								<td scope="row">1</td>
								<td width="7%">
									<img src="{{ url('assets/img/metode/cash.jpg') }}" alt="Profile" 
									style="border-radius: 5px; width: 170px; height: 5; padding-left: 50px;">
								</td>
								<td style="font-weight: bold;"> Cash </td>
								<td style="text-align: center; font-weight: bold;"> - </td>
							</tr>

							<tr class="text-center">
								<td scope="row">2</td>
								<td width="7%">
									<img src="{{ url('assets/img/metode/dana.png') }}" alt="Profile" 
									style="border-radius: 5px; width: 170px; height: 5; padding-left: 50px;">
								</td>
								<td style="font-weight: bold;"> Dana </td>
								<td style="text-align: center; font-weight: bold;"> +62 8512-3450-001 </td>
							</tr>

							<tr class="text-center">
								<td scope="row">3</td>
								<td width="7%">
									<img src="{{ url('assets/img/metode/ovo.png') }}" alt="Profile" 
									style="border-radius: 5px; width: 170px; height: 5; padding-left: 50px;">
								</td>
								<td style="font-weight: bold;"> Ovo </td>
								<td style="text-align: center; font-weight: bold;"> +62 8512-3450-001 </td>
							</tr>

							<tr class="text-center">
								<td scope="row">4</td>
								<td width="7%" style="align-content: center;">
									<img src="{{ url('assets/img/metode/shopeepay.png') }}" alt="Profile" 
									style="border-radius: 5px; width: 170px; height: 5; padding-left: 50px;">
								</td>
								<td style="font-weight: bold;"> Shoppe Pay </td>
								<td style="text-align: center; font-weight: bold;"> +62 8512-3450-002 </td>
							</tr>

							<tr class="text-center">
								<td scope="row">5</td>
								<td width="7%">
									<img src="{{ url('assets/img/metode/bri.png') }}" alt="Profile" 
									style="border-radius: 5px; width: 150px; height: 3; padding-left: 50px;">
								</td>
								<td style="font-weight: bold;"> M-Banking </td>
								<td style="text-align: center; font-weight: bold;"> 1234-01-001234-53-0 </td>
							</tr>

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
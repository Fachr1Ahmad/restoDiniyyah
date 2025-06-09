@extends('User.imyprofil')
@section('content')
@include('sweetalert::alert')

<!-- Page Header -->
<div class="container-fluid p-0 mb-5 page-header" style="height: 400px; display: flex; align-items: center; justify-content: center;">
    <div class="text-center">
	    <h3 class="display-4 mb-0 mt-lg-5 text-light font-weight-bold" style="font-size: 3rem;">My Profile</h3>
        <div class="d-inline-flex mb-lg-5">
			<p class="m-0 text-secondary font-weight-bold"><a class="text-secondary font-weight-bold m-0" href="/Home">Home</a></p>
            <p class="m-0 text-secondary font-weight-bold px-2">/</p>
            <p class="m-0 text-secondary font-weight-bold"><a class="text-secondary font-weight-bold m-0" href="{{ url('/myprofil') }}">MyProfile</a></p>
		</div>
    </div>
</div>
<!-- Page Header End -->

<section class="ftco-section ftco-cart">
    <div class="container" style="margin-top: -100px;">
        <div class="row justify-content-center">
            @foreach($user as $row)
            @if ($row->id == Auth::user()->id)
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class=" page-header text-white text-center">
                        <h4>Profile Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4 text-center">
                                @empty($row->foto)
                                <img src="{{ url('assets/img/user/nophoto.png') }}" class="img-fluid rounded-circle" alt="Profile" style="width: 150px; height: 150px;">
                                @else
                                <img src="{{ url('assets/img/user/'.$row->foto) }}" class="img-fluid rounded-circle" alt="Profile" style="width: 150px; height: 150px;">
                                @endempty
                            </div>
                            <div class="col-md-8">
                                <h5><strong>Nama Lengkap:</strong> {{ $row->name }}</h5>
                                <h5><strong>Email:</strong> {{ $row->email }}</h5>
                                <h5><strong>No HP:</strong> {{ $row->no_hp }}</h5>
                                <h5><strong>Alamat:</strong> {{ $row->alamat }}</h5>
                            </div>
                        </div>
                        <div class="text-center">
                            <a class="btn btn-success btn-sm" title="Detail Users" href="{{ route('myprofil.show', $row->id) }}">
                                <i class="fa fa-eye"></i> Lihat Detail
                            </a>
                            <a class="btn btn-secondary btn-sm" title="Ubah Users" href="{{ route('myprofil.edit', $row->id) }}">
                                <i class="bi bi-pencil-square"></i> Edit Profil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
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
    });
</script>

@endsection

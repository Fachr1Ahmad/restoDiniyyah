@extends('User.ipesan')
@section('content')
@if(Auth::user()->role == 'Customer') 

<div class="container-fluid p-0 mb-5 page-header" style="height: 400px; display: flex; align-items: center; justify-content: center;">
    <div class="text-center">
	    <h3 class="display-4 mb-0 mt-lg-5 text-light font-weight-bold" style="font-size: 3rem;">Kirim Testimoni</h3>
        <div class="d-inline-flex mb-lg-5">
			<p class="m-0 text-secondary font-weight-bold"><a class="text-secondary font-weight-bold m-0" href="/Home">Home</a></p>
            <p class="m-0 text-secondary font-weight-bold px-2">/</p>
            <p class="m-0 text-secondary font-weight-bold"><a class="text-secondary font-weight-bold m-0" href="{{ url('/testi_user/create') }}">Kirim Testimoni</a></p>
		</div>
    </div>
</div>
    
    <!-- Page Header End -->

<!-- Reservation Start -->
<div class="container-fluid py-5 mt-3">
    <div class="container">
        <div class="reservation position-relative">
            <div class="row align-items-center">
                <div class="col-lg-6 my-5 my-lg-0">
                    <div class="p-5">
                        <div class="mb-4">
                            <h1 class="text-white">Kirim Feedback Anda Sekarang</h1>
                        </div>
                        <p class="text-white">Ulasan anda sangat bermanfaat untuk kami <b>Resto Diniyyah Puteri</b>.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-center p-5">
                        <form method="POST" action="{{ route('testi_user.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group position-relative mb-4">
                                <input type="text" class="form-control bg-transparent text-white @error('users_id') is-invalid @enderror" 
                                    name="users_id" value="{{ Auth::user()->name }}" disabled>
                                <label class="form-label text-white" style="position: absolute; top: -20px; left: 10px;">Users ID</label>
                                @error('users_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group position-relative mb-4">
                                <textarea class="form-control bg-transparent text-white @error('pesan') is-invalid @enderror" 
                                    name="pesan" style="height: 100px;">{{ old('pesan') }}</textarea>
                                <label class="form-label text-white" style="position: absolute; top: -20px; left: 10px;">Isi Pesan</label>
                                @error('pesan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div>
                                <button class="btn btn-primary btn-block font-weight-bold py-3" type="submit">Kirim Sekarang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Reservation End -->
    @else
        @include('User.access_denied')
    @endif
    @endsection
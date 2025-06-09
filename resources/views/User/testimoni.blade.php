
@extends('User.itestimoni')
@section('content')
@include('sweetalert::alert')
<!-- Page Header Start -->
    <div class="container-fluid p-0 mb-5 page-header" style="height: 400px; display: flex; align-items: center; justify-content: center;">
	    <div class="text-center">
		    <h3 class="display-3 text-light m-0 font-weight-bold" style="font-size: 3rem;">Testimonial</h3>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-secondary font-weight-bold m-0"><a class="text-secondary font-weight-bold m-0" href="/Home">Home</a></p>
                <p class="m-0 text-secondary font-weight-bold m-0 px-2">/</p>
                <p class="m-0 text-secondary font-weight-bold m-0"><a class="text-secondary font-weight-bold m-0" href="/testi">Testimonial</a></p>
            </div>
	    </div>
    </div>
    
    <!-- Page Header End -->

 
 <!-- Testimonial Start -->
 <div class="container-fluid py-5">
        <div class="container">
           <div class="col-md-12 heading-section ftco-animate text-center">
                <h4 class="subheading text-primary">Testimoni</h4>
                <h1 class="mb-4">Resto Diniyyah Puteri</h1>
            </div>
			
            <div class="owl-carousel testimonial-carousel">
                @foreach($testimoni as $row)
                <div class="testimonial-item">
                    <div class="d-flex align-items-center mb-3">
                        @empty($row->users->foto)
                            <img src="{{ url('assets/img/user/nophoto.png') }}" width="100%" alt="Profile" style="border-radius: 5px;">
                        @else
                            <img src="{{ url('assets/img/user/'.$row->users->foto) }}" width="100%" alt="Profile" style="border-radius: 5px;">
                        @endempty
                        <!-- <img class="img-fluid" src="img/pr.jpg" alt=""> -->
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
        </div>
    </div>
    
    <!-- Testimonial End -->

    @endsection
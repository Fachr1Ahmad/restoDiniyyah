@extends('User.iregister')
@section('content')
<section class="section about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-6 align-self-center">
                <div class="content-block">
                    <h2>Terima Kasih <span class="alternate">Sudah Registrasi User</span></h2>
                    <div class="description-one">
                        <p>Silahkan Login</p>
                    </div>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="{{ url('login') }}" class="btn btn-primary" style="border-radius: 10px;">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
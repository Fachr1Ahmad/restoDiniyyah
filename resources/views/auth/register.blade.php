@extends('auth.ilogin')
@section('content')

<!-- Page Header -->
<div class="container-fluid page-header mb-5 position-relative ">
    <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
        <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Register</h1>
        <div class="d-inline-flex mb-lg-5">
            <p class="m-0 text-white"><a class="text-white" href="{{ url('/Home') }}">Home</a></p>
            <p class="m-0 text-white px-2">/</p>
            <p class="m-0 text-white"><a class="text-white" href="{{ url('/register') }}">Register</a></p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="shadow-sm border-0 rounded">
                <div class="card-body p-4">
                    <h4 class="text-primary text-center fw-bold mb-4">Create Your Account</h4>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name input -->
                        <div class="form-group mb-3">
                            <input id="name" type="text" 
                                class="form-input @error('name') is-invalid @enderror" 
                                name="name" value="{{ old('name') }}" 
                                required autocomplete="name" autofocus 
                                placeholder="Enter Your Name" 
                                style="color: black;">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Email input -->
                        <div class="form-group mb-3">
                            <input id="email" type="email" 
                                class="form-input @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" 
                                required autocomplete="email" 
                                placeholder="Enter a valid email address" 
                                style="color: black;">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password input -->
                        <div class="form-group mb-3">
                            <input id="password" type="password" 
                                class="form-input @error('password') is-invalid @enderror" 
                                name="password" required 
                                placeholder="Enter password" 
                                style="color: black;">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group mb-3">
                            <input id="password-confirm" type="password" 
                                class="form-input" 
                                name="password_confirmation" required 
                                autocomplete="new-password" 
                                placeholder="Enter your confirm password" 
                                style="color: black;">
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center">
                            <p class="mt-2 small" style="color: black;">Already have an account?
                                <a href="{{ route('login') }}" class="text-primary">
                                    {{ __('Login') }}
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

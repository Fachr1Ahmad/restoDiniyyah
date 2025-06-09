@extends('auth.ilogin')
@section('content')

<!-- Page Header -->
    <div class="container-fluid page-header mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="text-light m-0" style="font-size: 2.5rem;">Login</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a class="text-secondary font-weight-bold" href="{{ url('/Home') }}">Home</a></p>
                <p class="m-0 text-secondary px-2">/</p>
                <p class="m-0"><a class="text-secondary font-weight-bold" href="{{ url('/login') }}">Login</a></p>
            </div>
        </div>
    </div>
    </div>
<!-- Page Header End -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="shadow-sm border-0 rounded">
                <div class="card-body p-4">
                    <h4 class="text-primary text-center fw-bold mb-4">{{ __('Welcome Back') }}</h4>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Email input -->
                        <div class="form-group mb-3">
                            <input id="email" type="email" 
                                class="form-input @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" 
                                required autocomplete="email" autofocus 
                                placeholder="{{ __('Email Address') }}" 
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
                                placeholder="{{ __('Password') }}" 
                                style="color: black;">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" 
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember" style="color: black;">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                        </div>

                        <!-- Forgot Password and Register Links -->
                        <div class="text-center">
                            @if (Route::has('password.request'))
                                <a class="text-muted small" href="{{ route('password.request') }}" style="color: black;">
                                    {{ __('Forgot Password?') }}
                                </a>
                            @endif
                            <p class="mt-2 small" style="color: black;">{{ __("Don't have an account?") }}
                                <a href="{{ url('/register') }}" class="text-primary">
                                    {{ __('Register') }}
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





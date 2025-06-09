@extends('Admin.home')
@section('content')
<section class="section">
    <h2 class="mt-3 ms-3 text-primary fw-bold">Dashboard</h2>
    <nav>
        <ol class="breadcrumb mb-4 ms-3">
            <li class="breadcrumb-item"><a href="{{ url('pesanan') }}" class="text-decoration-none text-primary">Pesanan</a></li>
            <li class="breadcrumb-item active text-secondary">Form Input Pesanan</li>
        </ol>
    </nav>
    @session('message')
    <div class="alert alert-success">
        <p>{{ Session::get('message') }}</p>
    </div>
    @endsession
    @session('error')
    <div class="alert alert-danger">
        <p>{{ Session::get('error') }}</p>
    </div>
    @endsession
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card-footer shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center rounded-top">
                    <h5 class="mb-0 fw-bold">Form Input Pesanan</h5>
                    <a href="{{ url('pesanan') }}" class="btn btn-light btn-sm fw-bold">
                        <i class="fa fa-arrow-circle-left"></i> Back
                    </a>
                </div>
                <div class="card-body bg-light">
                    <h5 class="card-title text-center mb-5 fw-bold">Form Input Pesanan</h5>

                    <div class="row mb-4">
                        <label class="form-label fw-bold">Nama User</label>
                        <div class="col-sm-12">
                            <select class="form-select form-control @error('users_id') is-invalid @enderror" id="users_id" name="users_id">
                                <option value="">-- Pilih User --</option>
                                @foreach($users as $user)
                                    @if(auth()->user()->role == 'Kasir')
                                        @if($user->role == 'Kasir')
                                            @php $sel = ( old('users_id') == $user->id) ? 'selected' : ''; @endphp
                                            <option value="{{ $user->id }}" {{ $sel }}> {{ $user->name }}</option>
                                        @endif
                                    @else
                                        @php $sel = ( old('users_id') == $user->id) ? 'selected' : ''; @endphp
                                        <option value="{{ $user->id }}" {{ $sel }}> {{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('users_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col" id="menu">
                            @foreach($kategori as $kat)
                            @if (sizeof($kat->menu) > 1)
                            <h2 class="mt-4 text-primary fw-bold">{{ $kat->namaKategori }}</h2>
                            @endif
                            <div class="row">
                                @foreach($kat->menu as $menu)
                                <div class="col-md-4 mb-4">
                                    @livewire('product', ['menu' => $menu], key($menu->id))
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                        <div class="col mt-4">
                            @livewire('cart', [
                                'height' => 'height: calc(100vh - 225px);',
                                'top' => 'top: 80px;'
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const userSelect = document.getElementById('users_id');
            const chooseMenuBtn = document.getElementById('chooseMenuBtn');

            userSelect.addEventListener('change', function () {
                const userId = userSelect.value;
                if (userId) {
                    Livewire.dispatchTo('cart', 'setUser', {user_id: parseInt(userId)});    
                    chooseMenuBtn.classList.add('btn-primary');
                    chooseMenuBtn.classList.remove('pe-none', 'btn-secondary');
                } else {
                    Livewire.dispatchTo('cart', 'setUser', {user_id: ""});    
                    chooseMenuBtn.classList.add('pe-none', 'btn-secondary');
                    chooseMenuBtn.classList.remove('btn-primary');
                }
            });

            const selectMenuBtn = document.getElementById('selectMenuBtn');
            selectMenuBtn.addEventListener('click', function () {
                const menuId = document.querySelector('input[name="menu_id"]:checked');
                if (menuId) {
                    document.querySelector('input[name="menu_id"]').value = menuId.value;
                    const modal = bootstrap.Modal.getInstance(document.getElementById('productModal'));
                    modal.hide();
                }
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</section>
@endsection

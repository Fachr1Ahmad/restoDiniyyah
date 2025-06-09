@extends('Admin.home')
@section('content')
<section class="section">
    <h2 style="margin: 10px 0px 10px 10px; ">Dashboard</h2>
        <nav>
            <ol class="breadcrumb mb-4" style="margin-left: 10px;">
                <li class="breadcrumb-item"><a style="text-decoration: none; color: black;" href="{{ url('pembayaran') }}">Pembayaran</a></li>
                <li class="breadcrumb-item active">Form Input Pembayaran</li>
            </ol>
        </nav>
    <div class="row">
        <div class="col-lg-12">
            
            <div class="card">
                <div class="mt-4" style="width:550px; margin-left:18px;">
                    <a class="btn btn-warning btn-sm fw-bold" title="Kembali" 
                        href="{{ url('pembayaran') }}">
                        <i class="fa fa-arrow-circle-left"></i> Back
                    </a>
                </div>

                <div class="card-body">
                    <h5 class="card-title text-center mb-5">Form Input Pembayaran</h5>

                    <form class="row g-3" method="POST" action="{{ route('pembayaran.store') }}"
                        enctype="multipart/form-data">
                        @csrf

                        @php
                            // Ambil user yang sedang login
                            $currentUser = auth()->user();
                            // Jika admin, tampilkan semua user, jika kasir, hanya tampilkan user dengan role kasir
                            $filteredUsers = $currentUser->role == 'Admin'
                                ? $user_pesanan
                                : collect($user_pesanan)->where('role', 'Kasir');
                        @endphp
                        <div class="col-6">
                            <label class="form-label">User ID</label>
                            <div class="col-sm-12">
                                <select class="form-select form-control @error('users_id') is-invalid @enderror" id="user_id" name="users_id">
                                    <option value="">-- Pilih User Id --</option>
                                    @foreach($filteredUsers as $up)
                                        @php $sel = ( old('users_id') == $up->id) ? 'selected' : ''; @endphp
                                        <option value="{{ $up->id }}" {{ $sel }}>{{ $up->name }}</option>
                                    @endforeach
                                </select>
                                @error('users_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="form-label">Metode Pembayaran</label>
                            <div class="col-sm-12">
                                <select class="form-select form-control @error('metodePembayaran') 
                                        is-invalid @enderror" name="metodePembayaran">
                                    <option value="">-- Pilih Metode Pembayaran --</option>
                                    @foreach($mp as $mp)
                                    @php $sel = ( old('metodePembayaran') == $mp->id) ? 'selected' : ''; @endphp
                                    <option value="{{ $mp->id }}" {{ $sel }}>{{ $mp->metodePembayaran }}</option>
                                    @endforeach
                                </select>
                                @error('metodePembayaran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="form-label">Kode Pesanan</label>
                            <div class="col-sm-12">
                                <select class="form-select form-control @error('pesanan_id') is-invalid @enderror" id="pesanan_id" name="pesanan_id">
                                    <option id="default_option" disabled selected value="">-- Pilih Kode Pesanan --</option>
                                </select>
                                @error('pesanan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="inputNane4" class="form-label">Tanggal</label>
                            <input type="datetime-local" name="tanggal" placeholder="Tanggal" value="{{Carbon\Carbon::now() }}" 
                                class="form-control @error('tanggal') is-invalid @enderror">
                            @error('tanggal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="inputNane4" class="form-label">Foto</label>
                            <input class="form-control" type="file" name="buktiPembayaran" placeholder="foto">
                        </div>

                        <div class="text-center mt-5 mb-5" style="border-radius: 130px;">
                            <button type="submit" class="btn btn-success" style="margin-right: 10px;">Simpan</button>
                            <button type="reset" class="btn btn-dark" style="margin-right: 10px;">Batal</button>
                        </div>
                        
                    </form><!-- Vertical Form -->

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const userSelect = document.getElementById('user_id');
            const pesananSelect = document.getElementById('pesanan_id');
            const defaultOption = document.getElementById('default_option');
            
            // Data user_pesanan yang sudah di-encode di view
            const userPesanan = @json($user_pesanan); // Mengonversi data PHP ke JavaScript
    
            userSelect.addEventListener('change', function () {
                const userId = this.value;
                
                // Kosongkan opsi pesanan sebelumnya
                pesananSelect.innerHTML = '';
                pesananSelect.appendChild(defaultOption); // Tambahkan opsi default
                
                if (userId) {
                    const selectedUser = userPesanan.find(user => user.id == userId);
                    if (selectedUser && selectedUser.pesanans.length > 0) {
                        // Menambahkan option untuk pesanan yang sesuai
                        selectedUser.pesanans.forEach(pesanan => {
                            const option = document.createElement('option');
                            option.value = pesanan.id;
                            option.textContent = pesanan.order_id;
                            pesananSelect.appendChild(option);
                        });
                    } else {
                        // Jika tidak ada pesanan
                        pesananSelect.innerHTML = '<option value="" disabled selected>-- Tidak ada pesanan yang belum dibayar --</option>';
                    }
                }
            });
        });
    </script>
</section>

@endsection

<!-- resources/views/livewire/cart.blade.php -->
<!-- Container utama untuk keranjang belanja -->
<div class="border p-2 sticky-top" style="max-height: 98vh; {{ isset($top) ? $top : 'top: 25px;'}}">
    <!-- Container untuk item keranjang dengan scroll jika konten melebihi tinggi -->
    <div class="cart-container" style="overflow-y: auto; {{ isset($height) ? $height : 'height: calc(100vh - 180px);' }} ">
        <!-- Judul keranjang -->
        <h3 class="text-center">Keranjang {{ $cart->user->name ?? "Anda" }}</h3>

        <!-- Menampilkan pesan error jika ada -->
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Jika ada item di keranjang -->
        @if($cartItems && $cartItems->count() > 0)
        <div class="cart-items">
            <!-- Looping untuk setiap item di keranjang -->
            @foreach($cartItems as $item)
            <!-- Container untuk setiap item -->
            <div class="pb-2 w-100" wire:key="{{ $item->id }}">
                <div class="menu d-flex align-items-center justify-content-between p-3">
                    <!-- Gambar menu di sebelah kiri -->
                    <div class="d-flex flex-column">
                        <img src="{{ asset('assets/img/menu/' . $item->menu->foto) }}" class="card-img-top img-fluid"
                            style="height: 60px; width: 90px; object-fit: fit;" alt="{{ $item->menu->namaMenu }}">
                    </div>
                        
                    <!-- Nama menu dan harga di sebelah kanan -->
                    <div class="description d-flex flex-column ms-3 w-60">
                        <span><strong>{{ $item->menu->namaMenu }}</strong></span>
                        <span>Rp{{ number_format($item->menu->harga * $item->quantity, 0, ',', '.') }}</span>
                    </div>

                    <!-- Tombol untuk menambah dan mengurangi jumlah item -->
                    <div class="d-flex flex-column justify-content-between align-items-center mt-2">
                        <!-- Tombol tambah jumlah -->
                        <button wire:click="increase({{ $item->id }}, {{ $item->menu->id }}, 1)" class="btn btn-primary rounded-circle">✚</button>
                        <!-- Menampilkan jumlah item -->
                        <span class="mx-3">{{ $item->quantity }}</span>
                        <!-- Tombol kurangi jumlah -->
                        <button wire:click="decrease({{ $item->id }}, 1)" class="btn btn-primary rounded-circle">–</button>
                    </div>
                </div>                
            </div>
            @endforeach
        </div>
        @else
        <!-- Pesan jika keranjang kosong -->
        <div class="fw-bold d-flex align-items-center h-75 justify-content-center align-items-center">
            <p class="fw-bold text-center text-primary">Keranjang kosong</p>
        </div>
        @endif
    </div>

    <!-- Bagian total harga dan tombol checkout -->
    <div class="d-flex flex-column align-items-end mt-4">
        <!-- Menampilkan total harga -->
        <p class=" {{ $total > 0 ? '' : 'text-primary' }} font-weight-bold text-right">Total: {{ number_format($total) > 0 ? 'Rp. ' . number_format($total, 0, ',', '.') : '-' }}</p>
        <div class="w-100 gap-4 d-flex flex-row align-items-center justify-content-between">
            <!-- Dropdown untuk memilih meja -->
            <select class="form-select mw-50 p-2" aria-label="Pilih meja" wire:model.change="mejaTerpilih">
                <option value="" select/ed disabled>Pilih meja</option>
                @foreach ($meja as $m)
                    <option value="{{ $m->id }}" key="{{ $m->id }}">{{ $m->kodeMeja }}</option>
                @endforeach
            </select>
            <!-- Tombol checkout -->
            <button @disabled(number_format($total) <= 0 || !$mejaTerpilih) wire:click="checkout()" class="h-100 btn btn-primary">Checkout</button>
            <!-- Script untuk menangani event checkout sukses -->
            <script>
                document.addEventListener('livewire:load', function () {
                    Livewire.on('checkoutSuccess', function () {
                        window.location.href = '/cart';
                    }); 
                });
            </script>
        </div>
    </div>
</div>

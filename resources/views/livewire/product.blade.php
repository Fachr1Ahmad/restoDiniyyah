<div class="card h-100">
    <img src="{{ asset('assets/img/menu/' . $product->foto) }}" class="card-img-top img-fluid"
        style="height: 200px; width: 100%; object-fit: fit;" alt="{{ $product->namaMenu }}">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="m-0 card-title">{{ $product->namaMenu }}</h5>
        </div>
        <div class="d-flex flex-row align-items-center justify-content-between">
            <p class="m-0 card-text"><b>Harga:</b> Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
            <p class="m-0 text-primary fw-bold" style="font-size: 0.8rem">Stok: {{ $product->stok }}</p>
        </div>
    </div>
    <button class="btn {{ $product->stok < 1 || $disableAdd ? 'btn-primary disabled' : 'btn-primary' }} d-flex align-items-center gap-2" 
        wire:click.prevent="addToCart({{ $product->id }}, 1)" 
        {{ $product->stok < 1 || $disableAdd ? 'disabled' : '' }}>
        <i class="fas fa-shopping-cart"></i>
        <span>+ Keranjang</span>
    </button>
</div>
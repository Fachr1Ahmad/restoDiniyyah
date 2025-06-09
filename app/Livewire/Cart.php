<?php

namespace App\Livewire;

use App\Models\Cart as CartModel;
use App\Models\CartItem;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{
    public $cartItems;
    public $total = 0;
    public $cart;
    public $meja;
    public $mejaTerpilih = "";
    public $user_id;
    public $top;
    public $height;
    public $byAdmin = false;

    protected $listeners = ['setUser' => 'setUserId'];

    private function resetCart()
    {
        $this->cart = null;
        $this->cartItems = null;
        $this->user_id = null;
        $this->total = 0;
    }

    public function setUserId($user_id)
    {
        if (boolval($this->user_id) != boolval($user_id)) {
            $this->rendered();
        }
        if (!$user_id) {
            $this->resetCart();
        } else {
            $this->user_id = $user_id;
            $user = User::find($user_id);
            $this->cart = $user->cart ?: CartModel::create(['user_id' => $user->id]);
            $this->refreshCart();
        }
    }

    public function rendered() {
        $this->dispatch('checkBtn', !boolval($this->user_id))->to(Product::class);
    }
    
    public function mount($user_id = null) {
        $this->meja = Meja::all();
        if (in_array(Auth::user()->role, ["Admin", "Kasir"])) {
            $this->byAdmin = true;
        }
        if ($user_id) {
            $this->setUserId($user_id);
        }
    }

    public function refreshCart() {
        if ($this->cart) {
            $this->cart->calculateTotalPrice();
            $this->cartItems = CartItem::where('cart_id', $this->cart->id)
                ->with('menu')
                ->get();
            $this->total = $this->cartItems->sum(fn ($item) => $item->quantity * $item->menu->harga);
        }
    }

    #[On('addItem')] 
    public function addToCart($menu_id, $quantity) {
        $menu = Menu::find($menu_id);
        $cartItem = $this->cart->cartItems()->where('menu_id', $menu_id)->first();

        if ($cartItem) {
            if ($cartItem->quantity + $quantity <= $menu->stok ) {
                $cartItem->increment('quantity', $quantity);
            } else {
                session()->flash('error', 'Stok tidak cukup.');
            }
        } else {
            CartItem::create([
                'cart_id' => $this->cart->id,
                'menu_id' => $menu_id,
                'quantity' => $quantity,
            ]);
        }
        $this->refreshCart();
    }

    public function decrease($cart_item_id, $quantity) {
        $cart_item = CartItem::find($cart_item_id);
        if ($cart_item) {
            if ($cart_item->quantity <= 1) {
                $cart_item->delete();
            } else {
                $cart_item->decrement('quantity', $quantity);
            }
        }
        $this->refreshCart();
    }

    public function increase($cart_item_id, $menu_id, $quantity) {
        $cart_item = CartItem::find($cart_item_id);
        $menu = Menu::find($menu_id);
        if ($cart_item && ($cart_item->quantity + $quantity) <= $menu->stok ) {
            $cart_item->increment('quantity', $quantity);
        } else {
            session()->flash('error', 'tidak dapat melebihi stok'); 
        }
        $this->refreshCart();
    }

    public function removeItem($cart_item_id) {
        $cart_item = CartItem::find($cart_item_id);
        if ($cart_item) {
            $cart_item->delete();
        }
        $this->refreshCart();
    }

    public function checkout() {
        if ($this->cart && $this->cart->cartItems->isNotEmpty()) {
            // Buat record pesanan untuk cart ini
            $pesanan = Pesanan::create([
                'user_id' => $this->user_id,
                'meja_id' => $this->mejaTerpilih,
                'order_id' => 'DP-RSTO-' . date('YmdHis') . '-' . str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT),
                'total_harga' => $this->cart->total_harga,
                'status' => Pesanan::STATUS_PENDING, // Status awal adalah pending
            ]);
            // Menyimpan relasi many-to-many antara pesanan dan cartItems
            foreach($this->cart->cartItems as $product) {
                $pesanan->pesananItems()->create([
                    "menu_id" => $product->menu->id,
                    "quantity" => $product->quantity,
                ]);
                $product->menu->decrement('stok', $product->quantity);
                $product->menu->save();
            }
            $this->cart->cartItems()->delete();
            // Setelah pemesanan dibuat, kosongkan cart
            if ($this->byAdmin) {
                $this->refreshCart();
                return redirect()->route("pesanan.create")->with('message', 'Sukses membuat pesanan');
            }
            return redirect()->intended("/cart")->with('message', 'Pesanan berhasil dibuat silahkan lakukan pembayaran');
        } else {
            session()->flash('error','Gagal checkout, coba lagi.');
        }
    }

    public function render()
    {
        return view('livewire.cart', [
            'cartItems' => $this->cartItems,
            'total' => $this->total,
            'meja' => $this->meja,
        ]);
    }
}

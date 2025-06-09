<?php

namespace App\Livewire;

use App\Models\Menu;
use App\Models\Pesanan as PesananModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Pesanan extends Component
{
    public $pesanan;

    public function mount($pesanan = null) {
        if (!$pesanan) {
            $pesanan = PesananModel::where('user_id', Auth::id())
                        ->orderBy('created_at', 'DESC')
                        ->with('meja', 'pesananItems.menu')
                        ->get();
        }
        $this->pesanan = $pesanan;
    }

    #[On('remove-order')]
    public function removePesanan($order_id) { 
        $pesanan = PesananModel::where('order_id', $order_id)->first();
        $pesanan->delete();
    }

    public function render()
    {
        return view('livewire.pesanan', [
            "pesanan" => $this->pesanan,
        ]);
    }
}

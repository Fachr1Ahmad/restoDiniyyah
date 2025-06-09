<?php

namespace App\Livewire;

use App\Models\Menu;
use App\Models\Pesanan;
use Livewire\Component;

class PesananItem extends Component
{
    public $pesananItem;
    public $index;

    public function delete() {
        Pesanan::where('id', $this->pesananItem->id)->delete();
        return redirect()->route('pesanan.index')
            ->with('success', 'Data Pesanan Berhasil Dihapus');
    }

    public function cancel() {
        foreach ($this->pesananItem->pesananItems as $pesananItem) {
            $menu = Menu::where('id', $pesananItem->menu_id)->first();
            $menu->increment('stok', $pesananItem->quantity);
            $menu->save();
        }
        $this->pesananItem->status = Pesanan::STATUS_CANCELED;
        $this->pesananItem->save();
    }

    public function complete() {
        $this->pesananItem->status = Pesanan::STATUS_DONE;
        $this->pesananItem->save();
    }

    public function confirm() {
        return redirect()->intended("/pembayaran/create")->with('row', $this->pesananItem);
    }

    public function payment() {
        return redirect()->route('cart.show', $this->pesananItem->order_id);
    }

    public function render()
    {
        return view('livewire.pesanan-item', [
            "index" => $this->index,
            "pesananItem" => $this->pesananItem
        ]);
    }
    
}
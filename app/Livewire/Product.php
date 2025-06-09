<?php

namespace App\Livewire;

use Livewire\Component;

class Product extends Component
{
    public $product;
    public $disableAdd = true;

    public $listeners = [
        'checkBtn' => 'toggleBtn' 
    ];

    public function toggleBtn($state) {
        $this->disableAdd = $state;
    }

    public function mount($menu = null) {
        $this->product = $menu;
    }
    
    public function addToCart($menu_id, $quantity) {
        $this->dispatch('addItem', $menu_id, $quantity)->to(Cart::class);
    }

    public function render()
    {
        return view('livewire.product');
    }
}

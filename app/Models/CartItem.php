<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ["menu_id", "quantity", "cart_id", "harga"];

    public function cart() {
        return $this->belongsTo(Cart::class);
    }

    public function menu() {
        return $this->belongsTo(Menu::class);
    }
}

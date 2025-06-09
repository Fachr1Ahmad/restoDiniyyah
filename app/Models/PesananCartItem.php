<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananCartItem extends Model
{
    use HasFactory;

    protected $table = "pesanan_cart_item";
    protected $fillable = ["pesanan_id", "cart_item_id"];

    public function cartItem() {
        return $this->belongsTo(CartItem::class);
    }

    public function pesanan() {
        return $this->belongsTo(Pesanan::class);
    }
}

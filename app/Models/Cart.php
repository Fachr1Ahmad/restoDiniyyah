<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ["user_id", "total_harga"];

    public function user() {
        return $this->belongsTo(Userss::class, 'user_id');
    }

    public function cartItems() {
        return $this->hasMany(CartItem::class);
    }

    public function calculateTotalPrice() {
        $total = $this->cartItems->sum(function ($item) {
            return $item->quantity * $item->menu->harga;
        });

        $this->total_harga = $total;
        $this->save();
    }
}

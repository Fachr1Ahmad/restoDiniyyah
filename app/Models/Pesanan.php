<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = ["user_id", "meja_id", "order_id", "total_harga", "status"];

    const STATUS_PENDING = 'belum dibayar';
    const STATUS_DONE = 'selesai';
    const STATUS_CANCELED = 'dibatalkan';
    const STATUS_COOK = 'sedang dimasak';

    public function user() {
        return $this->belongsTo(Userss::class);
    }

    public function meja() {
        return $this->belongsTo(Meja::class);
    }

    public function pesananItems() {
        return $this->hasMany(PesananItem::class);
    }
}

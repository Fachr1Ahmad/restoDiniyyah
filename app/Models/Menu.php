<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Menyatakan bahwa tabel yang digunakan adalah 'menus'
    protected $table = 'menus';

    // Mapping ke kolom/field yang dapat diisi
    protected $fillable = ['namaMenu', 'status', 'harga', 'stok', 'foto', 'kategori_id'];

    // Relasi One to Many ke tabel DetailPesanan
    public function detailpesanan()
    {
        return $this->hasMany(DetailPesanan::class);
    }

    // Relasi One to Many ke tabel PesananItem
    public function pesananItems()
    {
        return $this->hasMany(PesananItem::class);
    }

    // Relasi Many to Many ke tabel CartItem
    public function cartItems()
    {
        return $this->belongsToMany(CartItem::class);
    }

    // Relasi ke tabel Kategori (tabel referensi)
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}

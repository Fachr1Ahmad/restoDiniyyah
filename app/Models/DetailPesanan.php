<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;

    //mapping ke tabel
    protected $table = 'detailpesanan';
    //mapping ke kolom/fieldnya
    protected $fillable = ['namaKategori'];

    //tabel relasi merujuk/merefer ke tabel master/acuan
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}

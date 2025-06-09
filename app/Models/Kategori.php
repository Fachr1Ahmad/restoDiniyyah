<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{

    use HasFactory;
    //mapping ke kolom/fieldnya
    protected $fillable = ['namaKategori'];

    //relasi one to many ke tabel menu
    public function menu()
    {
        return $this->hasMany(Menu::class, 'kategori_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;
    //mapping ke kolom/fieldnya
    protected $fillable = ['kodeMeja'];
    //relasi one to many ke tabel pegawai
    public function pesanan() {
        return $this->belongsToMany(Pesanan::class);
    }
}

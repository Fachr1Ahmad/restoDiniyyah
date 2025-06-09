<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    //mapping ke tabel
    protected $table = 'user';
    //mapping ke kolom/fieldnya
    protected $fillable = ['email','username','password','namaLengkap','noHP','role','alamat','foto'];

    //relasi one to many ke tabel pesanan
    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'user_id');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    use HasFactory;
        
    //mapping ke kolom/fieldnya
    protected $fillable = ['metodePembayaran'];

    public function pembayarans() {
        return $this->hasMany(Pembayaran::class);
    }
}

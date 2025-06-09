<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    //mapping ke tabel
    protected $table = 'pembayarans';

    const STATUS_UNCONFIRMED = 'Belum dikonfirmasi';
    const STATUS_CONFIRMED = 'Terkonfirmasi';
    const STATUS_DENIED = 'Ditolak';

    //mapping ke kolom/fieldnya
    protected $fillable = [
        'metode_pembayaran_id',
        'pesanan_id',
        'buktiPembayaran',
        'statusPembayaran'
    ];

    //relasi one to one ke tabel pesanan
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function users()
    {
        return $this->belongsTo(Userss::class);
    }

    public function metodePembayaran() {
        return $this->belongsTo(MetodePembayaran::class);
    }
}

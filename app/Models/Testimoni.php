<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;

    //mapping ke tabel
    protected $table = 'testimoni';

    //mapping ke kolom/fieldnya
    protected $fillable = ['pesan','date','users_id'];

    //tabel relasi merujuk/merefer ke tabel master/acuan
    public function users()
    {
        return $this->belongsTo(Userss::class);
    }
}

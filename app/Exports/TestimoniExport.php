<?php

namespace App\Exports;

use App\Models\Testimoni;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class TestimoniExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Testimoni::all();
        $ar_testimoni = DB::table('testimoni')
        ->join('users', 'users.id', '=', 'testimoni.users_id')
        ->select('users.name','users.role','users.alamat','testimoni.date','testimoni.pesan')
        ->get();
        return $ar_testimoni;
    }

    public function headings(): array
    {
        return ["Nama User", "Role", "Alamat", "Tanggal", "Isi Pesan"];
    }
}

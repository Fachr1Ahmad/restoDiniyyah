<?php

namespace App\Exports;

use App\Models\MetodePembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class MetodePembayaranExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return MetodePembayaran::all();
        $ar_metodepembayaran = DB::table('metodepembayaran')
        ->select('metodepembayaran.id','metodepembayaran.metodePembayaran',)
        ->get();
        return $ar_metodepembayaran;
    }

    public function headings(): array
    {
        return ["ID", "Metode Pembayaran",];
    }
}

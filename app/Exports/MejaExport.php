<?php

namespace App\Exports;

use App\Models\Meja;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class MejaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Meja::all();
        $ar_meja = DB::table('meja')
        ->select('meja.id','meja.kodeMeja',)
        ->get();
        return $ar_meja;
    }

    public function headings(): array
    {
        return ["ID", "Kode Meja",];
    }
}

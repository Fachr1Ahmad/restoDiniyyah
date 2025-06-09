<?php

namespace App\Exports;

use App\Models\Menu;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class MenuExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Menu::all();
        $ar_menu = DB::table('menu')
        ->join('kategori', 'kategori.id', '=', 'menu.kategori_id')
        ->select('menu.namaMenu','menu.status','menu.harga',
                'menu.stok','kategori.namaKategori','menu.foto')
        ->get();
        return $ar_menu;
    }

    public function headings(): array
    {
        return ["Nama Menu", "Status", "Harga", "Stok","Nama Kategori","Foto"];
    }
}

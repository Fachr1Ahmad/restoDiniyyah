<?php

namespace App\Exports;

use App\Models\Userss;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class UserssExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Users::all();
        $ar_users = DB::table('users')
        ->select('users.id','users.email','users.name','users.no_hp',
                'users.role','users.isactive','users.alamat','users.foto',)
        ->get();
        return $ar_users;
    }

    public function headings(): array
    {
        return ["ID", "Email", "Nama Lengkap","No HP",
                "Role","Is Active","Alamat","Foto"];
    }
}

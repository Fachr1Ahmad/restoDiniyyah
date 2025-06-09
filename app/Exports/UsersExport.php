<?php

namespace App\Exports;

use App\Models\Users;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Users::all();
        $ar_users = DB::table('user')
        ->select('user.id','user.email','user.username','user.password',
                 'user.namaLengkap','user.noHP','user.role','user.alamat',
                 'user.foto',)
        ->get();
        return $ar_users;
    }

    public function headings(): array
    {
        return ["ID", "Email", "Username", "Password","Nama Lengkap","No HP",
                "Role","Alamat","Foto"];
    }
}

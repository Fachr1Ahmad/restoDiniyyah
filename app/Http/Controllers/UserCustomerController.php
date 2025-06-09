<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userss;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use App\Exports\UserssExport;

class UserCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan seluruh data
        $user = Userss::orderBy('id', 'DESC')->get();
        return view('User.myprofil', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Userss::find($id); // Pastikan variabel $row terdefinisi
        return view('User.detail_profil', compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Userss::find($id); // Pastikan variabel $row terdefinisi
        return view('User.form_edit_profil', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //proses input pegawai
        $request->validate([
            'name' => 'required|max:45',
            'password' => 'required|min:8',
            'no_hp' => 'required|numeric',
            'alamat' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        // Ambil data pengguna yang akan diupdate
        $row = Userss::find($id); // Mendefinisikan variabel $row

        // Cek jika data tidak ditemukan
        if (!$row) {
            return redirect()->route('myprofil.index')->with('error', 'User not found');
        }

        //------------foto lama apabila user ingin ganti foto-----------
        $foto = DB::table('users')->select('foto')->where('id', $id)->get();
        foreach ($foto as $f) {
            $namaFileFotoLama = $f->foto;
        }

        //------------apakah user ingin ganti foto lama-----------
        if (!empty($request->foto)) {
            //jika ada foto lama, hapus foto lamanya terlebih dahulu
            if (!empty($row->foto)) unlink('assets/img/user' . $row->foto);
            //proses foto lama ganti foto baru
            $fileName = 'foto-' . $request->name . '.' . $request->foto->extension();
            $request->foto->move(public_path('assets/img/user'), $fileName);
        } else {
            $fileName = $namaFileFotoLama;
        }

        //lakukan update data dari request form edit
        DB::table('users')->where('id', $id)->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'foto' => $fileName,
            'updated_at' => now(),
        ]);

        return redirect()->route('myprofil.index')
        ->with('success', 'Data Users Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //sebelum hapus data, hapus terlebih dahulu fisik file fotonya jika ada
        $row = Userss::find($id); // Mendefinisikan variabel $row

        if (!$row) {
            return redirect()->route('kelola_user.index')->with('error', 'User not found');
        }

        if (!empty($row->foto)) unlink('assets/img/user/' . $row->foto);
        //setelah itu baru hapus data pesanan
        Userss::where('id', $id)->delete();
        return redirect()->route('kelola_user.index')
                         ->with('success', 'Data Users Berhasil Dihapus');
    }

    public function kelola_userPDF()
    {
        $user = Userss::all(); 
        $pdf = Facade::loadView('KelolaUser.kelola_userPDF', ['users' => $user]);
        return $pdf->download('data_users.pdf');
    }

    public function kelola_userExcel()
    {
        return Excel::download(new UserssExport, 'data_users.xlsx');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//tambahan
use App\Models\Userss;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

//excel
use App\Exports\UserssExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;

//excel
// use App\Exports\UsersExport;
// use Maatwebsite\Excel\Facades\Excel;

class UserssController extends Controller
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
       return view('KelolaUser.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ar_role = ['Admin','Kasir','Customer'];
        //arahkan ke form input data
        return view('KelolaUser.form',compact('ar_role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users|max:45',
            'name' => 'required|max:45',
            'password' => 'required|min:8',
            'role' => 'required|max:45',
            'isactive' => 'nullable|max:1',
            'no_hp' => 'required|numeric',
            'alamat' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ],
        [
            'email.required'=>'Email Wajib di Isi',
            'email.unique'=>'Email Sudah Ada (Terduplikasi)',
            'email.max'=>'Email Maksimal 45 Karakter',
            'name.required'=>'Name Wajib di Isi',
            'name.max'=>'Name Maksimal 45 Karakter',
            'password.required'=>'Password Wajib di Isi',
            'password.max'=>'Password Minimaml 8 Karakter',
            'isactive.max'=>'Is Active Maksimal 1 Angka',
            'role.required'=>'Role Wajib di Isi',
            'role.max'=>'Role Maksimal 45 Karakter',
        ]);
    
        //Pegawai::create($request->all());
        //------------apakah user  ingin upload foto-----------
        if(!empty($request->foto)){
            $fileName = 'foto-'.$request->name.'.'.$request->foto->extension();
            //$fileName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('assets/img/user'),$fileName);
        }
        else{
            $fileName = '';
        }

        //lakukan insert data dari request form
        DB::table('users')->insert(
            [
                'email'=>$request->email,
                'name'=>$request->name,
                'password'=>Hash::make($request->password),
                'role'=>$request->role,
                'isactive'=>$request->isactive,
                'no_hp'=>$request->no_hp,
                'alamat'=>$request->alamat,
                'foto'=>$fileName,
                'created_at'=>now(),
            ]);
    
        return redirect()->route('kelola_user.index')
                        ->with('success','Data Users Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Userss::find($id);
        return view('KelolaUser.detail',compact('row'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Userss::find($id);
        return view('KelolaUser.form_edit',compact('row'));
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
            // 'email' => 'required|unique:users|max:45',
            'name' => 'required|max:45',
            'password' => 'required|min:8',
            'role' => 'required|max:45',
            'isactive' => 'nullable|max:1',
            'no_hp' => 'required|numeric',
            'alamat' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);
        //------------foto lama apabila user ingin ganti foto-----------
        $row = Userss::find($id);
        $namaFileFotoLama = $row->foto;
        //------------apakah user ingin ganti foto lama-----------
        if(!empty($request->foto)){
            //jika ada foto lama, hapus foto lamanya terlebih dahulu
            if(!empty($row->foto)) unlink('assets/img/user/'.$row->foto);
            //proses foto lama ganti foto baru
            $fileName = 'foto-'.$request->name.'.'.$request->foto->extension();
            //$fileName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('assets/img/user'),$fileName);
        }
        //------------tidak berniat ganti ganti foto lama-----------
        else{
            $fileName = $namaFileFotoLama;
        }
        //lakukan update data dari request form edit
        DB::table('users')->where('id',$id)->update(
            [
                // 'email'=>$request->email,
                'name'=>$request->name,
                'password'=>Hash::make($request->password),
                'role'=>$request->role,
                'isactive'=>$request->isactive,
                'no_hp'=>$request->no_hp,
                'alamat'=>$request->alamat,
                'foto'=>$fileName,
                'updated_at'=>now(),
            ]);
    
        return redirect()->route('kelola_user.index')
                        ->with('success','Data Users Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //sebelum hapus data, hapus terlebih dahulu fisik file fotonya jika ada
        $row = Userss::find($id);
        if(!empty($row->foto)) unlink('assets/img/user/'.$row->foto);
        //setelah itu baru hapus data pesanan
        Userss::where('id',$id)->delete();
        return redirect()->route('kelola_user.index')
                        ->with('success','Data Users Berhasil Dihapus');
    }

    public function kelola_userPDF()
    {
        $user = Userss::all(); 
        //dd($pegawai);
        $pdf = PDF::loadView('KelolaUser.kelola_userPDF',['users'=>$user]);
        return $pdf->download('data_users.pdf');
    }

    public function kelola_userExcel() 
    {
        return Excel::download(new UserssExport, 'data_users.xlsx');
    }
}

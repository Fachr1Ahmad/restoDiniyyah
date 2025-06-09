<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//tambahan
use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;

//excel
use App\Exports\MenuExport;
use App\Http\Middleware\Peran;
use Maatwebsite\Excel\Facades\Excel;

class UserMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
       //menampilkan seluruh data
        //$menu = Menu::orderBy('id', 'DESC')->get();
        // mengambil data pegawai yang bernama Jamal Uwais
	    $makanan = Menu::where('kategori_id', '1')->get(); 
        $minuman = Menu::where('kategori_id', '2')->get(); 
        $dessert = Menu::where('kategori_id', '3')->get(); 
        $snack = Menu::where('kategori_id', '4')->get(); 

       return view('User.menupelanggan',compact('makanan','minuman','dessert','snack'));
    }

    public function apiMenu()
    {
        //menampilkan seluruh data
        $menu = Menu::all();

        return response()->json(
            [
                'success'=>true,
                'message'=>'Data Menu',
                'data'=>$menu,
            ],200);
    }

    public function apiMenuDetail($id)
    {
        //menampilkan detail data Menu
        $menu = Menu::find($id);
        
        if($menu){ //jika data Menu ditemukan
            return response()->json(
                [
                    'success'=>true,
                    'message'=>'Detail Menu',
                    'data'=>$menu,
                ],200);
        }
        else{ //jika data Menu tidak ditemukan
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Detail Menu Tidak ditemukan',
                ],404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //ambil master untuk dilooping di select option
        $ar_kategori = Kategori::all();
        $ar_status = ['Ready','Waiting List','Sold Out'];
        //arahkan ke form input data
        return view('User.pesanmenu',compact('ar_kategori','ar_status'));
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
            'namaMenu' => 'required|max:45',
            'status' => 'required|max:45',
            'harga' => 'required|max:45',
            'stok' => 'required|max:45',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'kategori_id' => 'required|max:45',
        ],
        [
            'namaMenu.required'=>'Nama Menu Wajib di Isi',
            'namaMenu.max'=>'Nama Menu Maksimal 45 Karakter',
            'status.required'=>'Status Wajib di Isi',
            'status.max'=>'Status Maksimal 45 Karakter',
            'harga.required'=>'Harga Wajib di Isi',
            'harga.max'=>'Harga Maksimal 45 Karakter',
            'stok.required'=>'Stok Wajib di Isi',
            'stok.max'=>'Stok Maksimal 45 Karakter',
            'kategori_id.required'=>'Kategori ID Wajib di Isi',
            'kategori_id.max'=>'Kategori ID Maksimal 45 Karakter',
        ]
        );
    
        //Pegawai::create($request->all());
        //------------apakah user  ingin upload foto----------- 
        if(!empty($request->foto)){
            $fileName = 'foto-'.$request->namaMenu.'.'.$request->foto->extension();
            //$fileName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('assets/img/menu'),$fileName);
        }
        else{
            $fileName = '';
        }

        //lakukan insert data dari request form
        DB::table('menu')->insert(
            [
                'namaMenu'=>$request->namaMenu,
                'status'=>$request->status,
                'harga'=>$request->harga,
                'stok'=>$request->stok,
                'foto'=>$fileName,
                'kategori_id'=>$request->kategori_id,
                'created_at'=>now(),
            ]);
    
        return redirect()->route('menu.index')
                        ->with('success','Data Menu Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Pastikan data ditemukan
        $row = Menu::find($id);
        if ($row) {
            return view('Menu.detail',compact('row'));
        } else {
            return redirect()->route('menu.index')->with('error', 'Menu not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Pastikan data ditemukan
        $row = Menu::find($id);
        if ($row) {
            return view('Menu.form_edit',compact('row'));
        } else {
            return redirect()->route('menu.index')->with('error', 'Menu not found');
        }
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
        // Pastikan data ditemukan
        $row = Menu::find($id);
        if (!$row) {
            return redirect()->route('menu.index')->with('error', 'Menu not found');
        }

        $request->validate([
            'namaMenu' => 'required|max:45',
            'status' => 'required|max:45',
            'harga' => 'required|max:45',
            'stok' => 'required|max:45',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'kategori_id' => 'required|max:45',
        ]);

        //------------foto lama apabila user ingin ganti foto-----------
        $foto = DB::table('menu')->select('foto')->where('id',$id)->get();
        foreach($foto as $f){
            $namaFileFotoLama = $f->foto;
        }
        //------------apakah user ingin ganti foto lama-----------
        if(!empty($request->foto)){
            //jika ada foto lama, hapus foto lamanya terlebih dahulu
            if(!empty($row->foto)) unlink('assets/img/menu'.$row->foto);
            //proses foto lama ganti foto baru
            $fileName = 'foto-'.$request->namaMenu.'.'.$request->foto->extension();
            //$fileName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('assets/img/menu'),$fileName);
        }
        //------------tidak berniat ganti ganti foto lama-----------
        else{
            $fileName = $namaFileFotoLama;
        }
        //lakukan update data dari request form edit
        DB::table('menu')->where('id',$id)->update(
            [
                'namaMenu'=>$request->namaMenu,
                'status'=>$request->status,
                'harga'=>$request->harga,
                'stok'=>$request->stok,
                'foto'=>$fileName,
                'kategori_id'=>$request->kategori_id,
                'updated_at'=>now(),
            ]);
    
        return redirect()->route('menu.index')
                        ->with('success','Data Menu Berhasil Di Update');
        
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
        $row = Menu::find($id);
        if(!empty($row->foto)) unlink('assets/img/menu/'.$row->foto);
        //setelah itu baru hapus data pesanan
        Menu::where('id',$id)->delete();
        return redirect()->route('menu.index')
                        ->with('success','Data Menu Berhasil Dihapus');
    }

    public function menuPDF()
    {
        $menu = Menu::all(); 
        //dd($pegawai);
        $pdf = Facade::loadView('Menu.menuPDF',['menu'=>$menu]);
        return $pdf->download('data_menu.pdf');
    }

    public function menuExcel() 
    {
        return Excel::download(new MenuExport, 'data_menu.xlsx');
    }
}

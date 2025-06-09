<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Http\Resources\MenuResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        //menampilkan seluruh data
        //$menu = Menu::all();
        $menu = Menu::join('kategori', 'kategori.id', '=', 'menu.kategori_id')
                    ->select('menu.namaMenu','menu.status','menu.harga',
                        'menu.stok','kategori.namaKategori','menu.foto')
                    ->get();

        return new MenuResource(true, 'Data Menu',$menu);
    }

    public function show($id)
    {
        //menampilkan detail data Menu
        //$menu = Menu::find($id);
        $menu = Menu::join('kategori', 'kategori.id', '=', 'menu.kategori_id')
                    ->select('menu.namaMenu','menu.status','menu.harga',
                        'menu.stok','kategori.namaKategori','menu.foto')
                    ->where('menu.id', '=', $id) 
                    ->get();
        
        return new MenuResource(true, 'Detail Data Menu',$menu);
    }

    public function store(Request $request)
    {
        //proses input Menu
        $validator = Validator::make($request->all(),[
            'namaMenu' => 'required|max:45',
            'status' => 'required|max:45',
            'harga' => 'required|max:45',
            'stok' => 'required|max:45',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'kategori_id' => 'required|max:45',
        ]);

        //cek error atau tidak inputan data
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        //------------apakah user  ingin upload foto-----------
        if(!empty($request->foto)){
            $fileName = 'foto-'.$request->namaMenu.'.'.$request->foto->extension();
            //$fileName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('assets/img/menu'),$fileName);
        }
        else{
                $fileName = '';
        }

        //proses menyimpan data yg diinput
        $menu = Menu::create([
            'namaMenu'=>$request->namaMenu,
            'status'=>$request->status,
            'harga'=>$request->harga,
            'stok'=>$request->stok,
            'foto'=>$fileName,
            'kategori_id'=>$request->kategori_id,
            'created_at'=>now(),
        ]);

        return new MenuResource(true, 'Data Menu Berhasil diinput',$menu);              
    }

    public function update(Request $request, $id)
    {
         //proses ubah menu
         $validator = Validator::make($request->all(),[
            'namaMenu' => 'required|max:45',
            'status' => 'required|max:45',
            'harga' => 'required|max:45',
            'stok' => 'required|max:45',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'kategori_id' => 'required|max:45',
        ]);

        //cek error atau tidak inputan data
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }

        //------------foto lama apabila user ingin ganti foto-----------
        $foto = DB::table('menu')->select('foto')->where('id',$id)->get();
        foreach($foto as $f){
            $namaFileFotoLama = $f->foto;
        }
        //------------apakah user ingin ganti foto lama-----------
        if(!empty($request->foto)){
            //jika ada foto lama, hapus foto lamanya terlebih dahulu
            if(!empty($f->foto)) unlink('assets/img/menu/'.$f->foto);
            //proses foto lama ganti foto baru
            $fileName = 'foto-'.$request->namaMenu.'.'.$request->foto->extension();
            //$fileName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('assets/img/menu'),$fileName);
        }
        //------------tidak berniat ganti ganti foto lama-----------
        else{
            $fileName = $namaFileFotoLama;
        }

        //proses update data yg diinput
        $menu = Menu::whereId($id)->update([
            'namaMenu'=>$request->namaMenu,
            'status'=>$request->status,
            'harga'=>$request->harga,
            'stok'=>$request->stok,
            'foto'=>$fileName,
            'kategori_id'=>$request->kategori_id,
            'updated_at'=>now(),
        ]);

        return new MenuResource(true, 'Data  Menu Berhasil Diubah', $menu);              
    }

    public function destroy($id){
        $menu = Menu::whereId($id)->first();
        $menu->delete();

        //return respon
        return new MenuResource(true, 'Data Menu Berhasil Dihapus', $menu);  
    }
}

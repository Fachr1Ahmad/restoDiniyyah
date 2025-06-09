<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

//excel
use App\Exports\KategoriExport;
use Maatwebsite\Excel\Facades\Excel;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan seluruh data
        $kategori = Kategori::orderBy('id', 'DESC')->get();
        return view('Kategori.index',compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //arahkan ke form input data
        return view('Kategori.form');
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
            'namaKategori' => 'required|max:100'
        ],
        [
            'namaKategori.required'=>'Nama Kategori Wajib di Isi',
            'namaKategori.max'=>'Nama Kategori Maksimal 100 Karakter',
        ]
        );
    
        Kategori::create($request->all());
    
        return redirect()->route('kategori.index')
                        ->with('success','Data Kategori Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Kategori::find($id);
        return view('Kategori.detail',compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Kategori::find($id);
        return view('Kategori.form_edit',compact('row'));
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
        $request->validate([
            'namaKategori' => 'required|max:100'
        ]);

        //lakukan update data dari request form edit
        DB::table('kategoris')->where('id',$id)->update(
            [
                'namaKategori'=>$request->namaKategori,
                'updated_at'=>now(),
            ]);
    
        return redirect()->route('kategori.index')
                        ->with('success','Data Kategori Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //setelah itu baru hapus data pesanan
        Kategori::where('id',$id)->delete();
        return redirect()->route('kategori.index')
                        ->with('success','Data Kategori Berhasil Di hapus');
    }

    public function kategoriPDF()
    {
        $kategori = Kategori::all(); 
        //dd($pegawai);
        $pdf = PDF::loadView('Kategori.kategoriPDF',['kategori'=>$kategori]);
        return $pdf->download('data_kategori.pdf');
    }

    public function kategoriExcel() 
    {
        return Excel::download(new KategoriExport, 'data_kategori.xlsx');
    }
}

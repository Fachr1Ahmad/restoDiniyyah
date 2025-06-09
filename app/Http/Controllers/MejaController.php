<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//tambahan

use App\Models\Meja;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

//excel
use App\Exports\MejaExport;
use Maatwebsite\Excel\Facades\Excel;


class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan seluruh data
        $meja = Meja::orderBy('id', 'DESC')->get();
        return view('Meja.index',compact('meja'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //arahkan ke form input data
        return view('Meja.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'kodeMeja' => 'required|max:3'
        ],
        [
            'kodeMeja.required'=>'Kode Meja Wajib di Isi',
            'kodeMeja.max'=>'Kode Meja Maksimal 3 Karakter',
        ]
        );

        Meja::create($request->all());
        return redirect()->route('meja.index')
                        ->with('success','Data Meja Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Meja::find($id);
        return view('Meja.detail',compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Meja::find($id);
        return view('Meja.form_edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $request->validate([
            'kodeMeja' => 'required|max:3'
        ]);

        //lakukan update data dari request form edit
        DB::table('mejas')->where('id',$id)->update(
            [
                'kodeMeja'=>$request->kodeMeja,
                'updated_at'=>now(),
            ]);
    
        return redirect()->route('meja.index')
                        ->with('success','Data Meja Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //setelah itu baru hapus data pesanan
        Meja::where('id',$id)->delete();
        return redirect()->route('meja.index')
                        ->with('success','Data Meja Berhasil Dihapus');
    }

    public function mejaPDF()
    {
        $meja = Meja::all(); 
        //dd($pegawai);
        $pdf = PDF::loadView('Meja.mejaPDF',['meja'=>$meja]);
        return $pdf->download('data_meja.pdf');
    }

    public function mejaExcel() 
    {
        return Excel::download(new MejaExport, 'data_meja.xlsx');
    }
}

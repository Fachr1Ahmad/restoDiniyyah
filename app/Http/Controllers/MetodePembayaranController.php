<?php

namespace App\Http\Controllers;

use App\Exports\MetodePembayaranExport;
use Illuminate\Http\Request;
//tambahan
use App\Models\MetodePembayaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;

//excel
use Maatwebsite\Excel\Facades\Excel;


class MetodePembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan seluruh data
       $mp = MetodePembayaran::orderBy('id', 'DESC')->get();
       return view('MetodePembayaran.index',compact('mp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //arahkan ke form input data
        return view('MetodePembayaran.form');
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
            'metodePembayaran' => 'required|max:45'
        ]);
      
        MetodePembayaran::create($request->all());
       
        return redirect()->route('metodepembayaran.index')
                        ->with('success','Data Metode Pembayaran Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = MetodePembayaran::find($id);
        return view('MetodePembayaran.detail',compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = MetodePembayaran::find($id);
        return view('MetodePembayaran.form_edit',compact('row'));
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
            'metodePembayaran' => 'required|max:45'
        ],
        [
            'metodePembayaran.required'=>'Metode Pembayaran Wajib di Isi',
            'metodePembayaran.max'=>'Metode Pembayaran Maksimal 45 Karakter',
        ]
        );

        //lakukan update data dari request form edit
        DB::table('metodepembayaran')->where('id',$id)->update(
            [
                'metodePembayaran'=>$request->metodePembayaran,
                'updated_at'=>now(),
            ]);
    
        return redirect()->route('metodepembayaran.index')
                        ->with('success','Data Metode Pembayaran Berhasil Di Update');
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
        MetodePembayaran::where('id',$id)->delete();
        return redirect()->route('metodepembayaran.index')
                        ->with('success','Data Metode Pembayaran Berhasil Dihapus');
    }

    public function metodepembayaranPDF()
    {
        $mp = MetodePembayaran::all(); 
        //dd($pegawai);
        $pdf = Facade::loadView('MetodePembayaran.metodepembayaranPDF',['metodepembayaran'=>$mp]);
        return $pdf->download('data_metodepembayaran.pdf');
    }

    public function metodepembayaranExcel() 
    {
        return Excel::download(new MetodePembayaranExport, 'data_metodepembayaran.xlsx');
    }
}

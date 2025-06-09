<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//tambahan
use App\Models\Testimoni;
use App\Models\Userss;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;

//excel
use App\Exports\TestimoniExport;
use App\Http\Middleware\Peran;
use Maatwebsite\Excel\Facades\Excel;

class TestimoniAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan seluruh data
        $testimoni = Testimoni::orderBy('id', 'DESC')->get();
        return view('Testimoni.index',compact('testimoni'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //ambil master untuk dilooping di select option
       $ar_users = Userss::all();
       //arahkan ke form input data
       return view('Testimoni.form',compact('ar_users'));
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
            'users_id' => 'required',
            'pesan' => 'required|max:255',
        ],
        [
            'users_id.required'=>'Kode Pesanan Wajib di Isi',
            'pesan.required'=>'Isi Pesan Wajib di Isi',
            'pesan.max'=>'Isi Pesan Maksimal 255 Karakter',
        ]);
    
        // Testimoni::create($request->all());
        //lakukan insert data dari request form
        DB::table('testimoni')->insert(
        [
            'users_id'=>$request->users_id,
            'pesan'=>$request->pesan,
            'date'=>now(),
            'created_at'=>now(),
        ]);
    
        return redirect()->route('testimoni.index')
                        ->with('success','Data Testimoni Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Testimoni::find($id);
        return view('Testimoni.detail',compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Testimoni::find($id);
        return view('Testimoni.form_edit',compact('row'));
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
            'users_id' => 'required',
            'pesan' => 'required|max:255',
        ],
        [
            'users_id.required'=>'Kode Pesanan Wajib di Isi',
            'pesan.required'=>'Isi Pesan Wajib di Isi',
            'pesan.max'=>'Isi Pesan Maksimal 255 Karakter',
        ]);
        
        
        //lakukan update data dari request form edit
        DB::table('testimoni')->where('id',$id)->update(
            [
                'users_id'=>$request->users_id,
                'pesan'=>$request->pesan,
                'date'=>now(),
                'updated_at'=>now(),
            ]);
    
        return redirect()->route('testimoni.index')
                        ->with('success','Data Testimoni Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //setelah itu baru hapus data pesanan
        Testimoni::where('id',$id)->delete();
        return redirect()->route('testimoni.index')
                        ->with('success','Data Testimoni Berhasil Dihapus');
    }

    public function testimoniPDF()
    {
        $testimoni = Testimoni::all(); 
        //dd($pegawai);
        $pdf = Facade::loadView('Testimoni.testimoniPDF',['testimoni'=>$testimoni]);
        return $pdf->download('data_testimoni.pdf');
    }

    public function testimoniExcel() 
    {
        return Excel::download(new TestimoniExport, 'data_testimoni.xlsx');
    }
}

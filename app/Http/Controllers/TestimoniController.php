<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
//tambahan
use App\Models\Testimoni;
use App\Models\Userss;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;

class TestimoniController extends Controller
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
        return view('User.testimoni',compact('testimoni'));
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
       return view('User.formtesti',compact('ar_users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'pesan' => 'required|max:255',
        ],
        [
            'pesan.required'=>'Isi Pesan Wajib di Isi',
            'pesan.max'=>'Isi Pesan Maksimal 255 Karakter',
        ]);

        $users_id =  Auth::user()->id;
        //lakukan insert data dari request form
        DB::table('testimoni')->insert(
        [
                'users_id'=>$users_id,
                'pesan'=>$request->pesan,
                'date'=>now(),
                'created_at'=>now(),
        ]);

        // Testimoni::create($request->all());
    
        return redirect()->route('testi_user.index')
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

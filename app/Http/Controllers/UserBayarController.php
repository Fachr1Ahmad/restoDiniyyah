<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Userss;
use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;

use App\Exports\PembayaranExport;
use App\Models\MetodePembayaran;
use Maatwebsite\Excel\Facades\Excel;

class UserBayarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan seluruh data
        $pembayaran = Pembayaran::orderBy('id', 'DESC')->with('metodePembayaran', 'pesanan')->get();

        return view('User.bayar', compact('pembayaran'));
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
        $ar_mp = ['Cash', 'Ovo', 'Dana', 'Shopee Pay', 'Gopay', 'M-Banking'];
        $ar_p = Pesanan::all();

        //arahkan ke form input data
        return view('User.formbayar', compact('ar_users', 'ar_mp', 'ar_p'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'metodePembayaran' => 'required|max:45',
                'pesanan_id' => 'required|max:45',
                'buktiPembayaran' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            ],
            [
                'metodePembayaran.required' => 'Metode Pembayaran Wajib di Isi',
                'metodePembayaran.max' => 'Metode Pembayaran Maksimal 45 Karakter',
                'pesanan_id.required' => 'Pesanan id Wajib di Isi',
            ]
        );
        //------------apakah user  ingin upload foto-----------
        if (!empty($request->buktiPembayaran)) {
            $fileName = 'bukti-' . $request->pesanan_id . '.' . $request->buktiPembayaran->extension();
            //$fileName = $request->foto->getClientOriginalName();
            $request->buktiPembayaran->move(public_path('assets/img/bukti'), $fileName);
        } else {
            $fileName = '';
        }

        Pembayaran::create([
            'metode_pembayaran_id' => $request->metodePembayaran,
            'pesanan_id' => $request->pesanan_id,
            'buktiPembayaran' => $fileName,
            'statusPembayaran' => 'Menunggu konfirmasi kasir',
        ]);
        return redirect()->route('bayar.index')
            ->with('success', 'Data Pembayaran Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //setelah itu baru hapus data pesanan
        Pembayaran::where('id', $id)->delete();
        return redirect()->route('pembayaran.index')
            ->with('success', 'Data Pembayaran Berhasil Dihapus');
    }

    public function bayarPDF()
    {
        $pembayaran = Pembayaran::all();
        //dd($pegawai);
        $pdf = Facade::loadView('User.userbayarPDF', ['pembayaran' => $pembayaran]);
        return $pdf->download('History_pembayaran.pdf');
    }
}

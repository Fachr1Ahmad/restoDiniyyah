<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Userss;
use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;
use App\Exports\PembayaranExport;
use App\Models\Menu;
use App\Models\MetodePembayaran;
use App\Models\Users;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Facade;
use Carbon\Carbon;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan seluruh data
        $pembayaran = Pembayaran::orderBy('id', 'DESC')->get();
        $ar_mp = ['Cash', 'Ovo', 'Dana', 'Shopee Pay', 'Gopay', 'M-Banking'];

        return view('Pembayaran.index', compact('pembayaran', 'ar_mp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //ambil master untuk dilooping di select option
        $user_pesanan = Userss::with(['pesanans' => function ($query) {
            $query->whereIn('status', ['belum dibayar']);
        }])->get();
        $mp = MetodePembayaran::all();
        //arahkan ke form input data
        return view('Pembayaran.form', compact('user_pesanan', 'mp'));
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
                'users_id' => 'required|max:45',
                'metodePembayaran' => 'required|max:45',
                'tanggal' => 'required|max:45',
                'pesanan_id' => 'required|max:45',
                'buktiPembayaran' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            ],
            [
                'users_id.required' => 'User ID Wajib di Isi',
                'metodePembayaran.required' => 'Metode Pembayaran Wajib di Isi',
                'tanggal.required' => 'Tanggal Wajib di Isi',
                'pesanan_id.required' => 'Wajib di Isi',
            ]
        );

        //------------apakah user  ingin upload foto-----------
        if (!empty($request->buktiPembayaran)) {
            $fileName = 'bukti-' . $request->pesanan_id . '.' . $request->buktiPembayaran->extension();
            $request->buktiPembayaran->move(public_path('assets/img/bukti'), $fileName);
        } else {
            $fileName = '';
        }

        Pembayaran::create([
            "user_id" => $request->users_id,
            "pesanan_id" => $request->pesanan_id,
            "metode_pembayaran_id" => $request->metodePembayaran,
            "created_at" => $request->tanggal,
            "updated_at" => now(),
            "buktiPembayaran" => $fileName,
            "statusPembayaran" => Pembayaran::STATUS_UNCONFIRMED
        ]);

        return redirect()->route('pembayaran.index')
            ->with('success', 'Data Pembayaran Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Pembayaran::where('id', $id)->with('pesanan', 'metodePembayaran')->first();
        if ($row) {
            return view('Pembayaran.detail', compact('row'));
        } else {
            return redirect()->route('pembayaran.index')->with('error', 'Pembayaran tidak ditemukan');
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
        $row = Pembayaran::where('id', $id)->with('pesanan', 'metodePembayaran')->first();
        if ($row) {
            return view('Pembayaran.form_edit', compact('row'));
        } else {
            return redirect()->route('pembayaran.index')->with('error', 'Pembayaran tidak ditemukan');
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
        $request->validate([
            'metodePembayaran_id' => 'required|max:45',
            'pesanan_id' => 'required|max:45',
            'statusPembayaran' => 'required|max:45',
            'buktiPembayaran' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        //------------foto lama apabila user ingin ganti foto-----------
        $buktiPembayaran = Pembayaran::select('buktiPembayaran')->where('id', $id)->first();
        $namaFileFotoLama = $buktiPembayaran ? $buktiPembayaran->buktiPembayaran : '';

        // Proses ganti foto
        if (!empty($request->buktiPembayaran)) {
            // Hapus foto lama jika ada
            if (!empty($namaFileFotoLama) && file_exists(public_path('assets/img/bukti/' . $namaFileFotoLama))) {
                unlink(public_path('assets/img/bukti/' . $namaFileFotoLama));
            }
            // Upload foto baru
            $fileName = 'bukti-' . $request->pesanan_id . '.' . $request->buktiPembayaran->extension();
            $request->buktiPembayaran->move(public_path('assets/img/bukti'), $fileName);
        } else {
            // Jika tidak ganti foto, gunakan foto lama
            $fileName = $namaFileFotoLama;
        }
        $pembayaran = Pembayaran::where('id', $id)->first();
        // Update data pembayaran
        $pembayaran->update([
            'statusPembayaran' => $request->statusPembayaran == "Konfirmasi" ? Pembayaran::STATUS_CONFIRMED : Pembayaran::STATUS_DENIED,
            'buktiPembayaran' => $fileName,
        ]);

        if ($pembayaran->statusPembayaran == Pembayaran::STATUS_DENIED) {
            foreach ($pembayaran->pesanan->pesananItems as $pesananItem) {
                $menu = Menu::where('id', $pesananItem->menu_id)->first();
                $menu->increment('stok', $pesananItem->quantity);
                $menu->save();
            }
            $pembayaran->pesanan->status = Pesanan::STATUS_CANCELED;
            $pembayaran->pesanan->save();
            return redirect()->route('pembayaran.index')
                ->with('success', 'Data Pembayaran Ditolak');
        } else {
            $pembayaran->pesanan->update([
                'status' => Pesanan::STATUS_COOK
            ]);

            return redirect()->route('pembayaran.index')
                ->with('success', 'Data Pembayaran Berhasil Dikonfirmasi');
        }
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
        Pembayaran::where('id', $id)->delete();
        return redirect()->route('pembayaran.index')
            ->with('success', 'Data Pembayaran Berhasil Dihapus');
    }


    public function pembayaranPDF(Request $request)
    {
        // Ambil input dari request (sesuai nama di modal Anda)
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
        $status_pembayaran = $request->input('status_pembayaran'); // Menggunakan 'status_pembayaran'

        // Validasi dasar (minimal tanggal harus ada, sesuai 'required' di modal)
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
            'status_pembayaran' => 'nullable|string', // Status bisa kosong/null
        ]);

        // Mulai query builder
        $query = Pembayaran::query()->with(['pesanan.user', 'metodePembayaran']);

        // Terapkan filter tanggal
        $query->whereBetween('updated_at', [
            Carbon::parse($tanggal_awal)->startOfDay(), // Mulai dari 00:00:00
            Carbon::parse($tanggal_akhir)->endOfDay()     // Sampai 23:59:59
        ]);

        // Terapkan filter status jika ada (tidak kosong)
        if (!empty($status_pembayaran)) {
            $query->where('statusPembayaran', $status_pembayaran); // Filter berdasarkan status
        }

        // Ambil data yang sudah difilter
        $pembayaran = $query->get();

        // Buat nama file PDF yang dinamis
        $fileName = 'Laporan_pembayaran';
        $fileName .= '_' . $tanggal_awal . '_hingga_' . $tanggal_akhir;
        if (!empty($status_pembayaran)) $fileName .= '_status_' . ucfirst($status_pembayaran);
        $fileName .= '.pdf';

        // Data untuk dikirim ke view PDF
        $data = [
            'pembayaran' => $pembayaran,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'status_pembayaran' => $status_pembayaran // Kirim juga statusnya
        ];

        // Load view PDF dan kirim data
        $pdf = Pdf::loadView('Pembayaran.pembayaranPDF', $data);

        // Unduh file PDF (atau tampilkan di browser dengan ->stream())
        return $pdf->download($fileName);
    }

    // ... (Fungsi controller Anda yang lain) ...


    public function pembayaranExcel(Request $request)
    {
        $tgl_awal = $request->input('tanggal_awal');
        $tgl_akhir = $request->input('tanggal_akhir');
        $status_pembayaran = $request->input('status_pembayaran');

        // Tambahkan satu hari ke tanggal akhir agar filter sampai akhir hari
        $tgl_akhir_plus = date('Y-m-d', strtotime('+1 day', strtotime($tgl_akhir)));

        // Kirim filter ke export
        return Excel::download(
            new PembayaranExport($tgl_awal, $tgl_akhir_plus, $status_pembayaran), 
            'Laporan pembayaran' 
                . ($tgl_awal ? ' ' . $tgl_awal : '') 
                . ($tgl_akhir ? ' - ' . $tgl_akhir : '') 
                . ($status_pembayaran ? ' - ' . ucfirst($status_pembayaran) : '') 
                . '.xlsx'
        );
    }
}
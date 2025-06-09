<?php
namespace App\Http\Controllers;
use App\Models\Pesanan;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $ar_menu = Menu::select('namaMenu','stok')->get();
        $pesanan = Pesanan::orderBy('id', 'DESC')->get();
        
        $ar_role = DB::table('user')
            ->selectRaw('role, count(role) as jumlah')
            ->groupBy('role')
            ->get();
        return view('Admin.index', compact('ar_menu', 'pesanan', 'ar_role'));
    }
}

<?php

use App\Http\Controllers\api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PesanMenuController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\UserssController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\UserMenuController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\TestimoniAdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserPesananController;
// use App\Http\Controllers\UserPesanController;
use App\Http\Controllers\UserBayarController;
use App\Http\Controllers\UserCustomerController;
use App\Livewire\Pesanan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   return view('master');
});
Route::get('/detail', function () {
    return view('User.detail');
});

Route::get('/menu', function () {
    return view('User.menu');
});

Route::get('/pesanmenu', function () {
    return view('User.pesanmenu');
});

Route::get('/login', function () {
    return view('auth.login');
});
Route::post('/login',[AuthController::class, 'login'])->name('login');
Route::post("/logout", [AuthController::class, 'logout'])->name("logout");
Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/myprofil', function () {
    return view('KelolaUser.myprofil');
});

Route::get('/about', function () {
    return view('User.about');
});


Route::get('order', Pesanan::class);

//----------------------routing halaman admin -----------------------------

Route::resource('menu',MenuController::class)->middleware('auth');
// Route::get('menu-edit/{id}', [MenuController::class,'edit']);
Route::get('menu-pdf', [MenuController::class,'menuPDF'])->middleware('auth');
Route::get('menu-excel', [MenuController::class,'menuExcel'])->middleware('auth');

Route::resource('kategori',KategoriController::class)->middleware('auth');
// Route::get('kategori-edit/{id}', [KategoriController::class,'edit']);
Route::get('kategori-pdf', [KategoriController::class,'kategoriPDF'])->middleware('auth');
Route::get('kategori-excel', [KategoriController::class,'kategoriExcel'])->middleware('auth');

Route::resource('meja',MejaController::class)->middleware('auth');
// Route::get('meja-edit/{id}', [MejaController::class,'edit']);
Route::get('meja-pdf', [MejaController::class,'mejaPDF'])->middleware('auth');
Route::get('meja-excel', [MejaController::class,'mejaExcel'])->middleware('auth');


//group hak akses admin kasir
Route::middleware(['peran:Admin-Kasir'])->group(function() {

    //----------------------routing halaman data master -----------------------------
    
    Route::resource('users',UsersController::class);
    // Route::get('users-edit/{id}', [UsersController::class,'edit']);
    Route::get('users-pdf', [UsersController::class,'usersPDF']);
    Route::get('users-excel', [UsersController::class,'usersExcel']);

    //----------------------routing halaman data pesanan -----------------------------
    Route::resource('pesanan', PesananController::class);
    Route::get('pesanan-edit/{id}', [PesananController::class,'edit']);
    Route::get('pesanan-pdf', [PesananController::class,'index']);
    Route::post('pesanan-pdf', [PesananController::class,'pesananPDF']);
    Route::get('pesanan-excel', [PesananController::class,'pesananExcel']);
    
    Route::resource('pembayaran',PembayaranController::class);
    // Route::get('pembayaran-edit/{id}', [PembayaranController::class,'edit']);
    Route::get('pembayaran-pdf', [PembayaranController::class,'pembayaranPDF']);
    Route::get('pembayaran-excel', [PembayaranController::class,'pembayaranExcel']);
    
    Route::resource('metodepembayaran',MetodePembayaranController::class);
    // Route::get('metodepembayaran-edit/{id}', [MetodePembayaranController::class,'edit']);
    Route::get('metodepembayaran-pdf', [MetodePembayaranController::class,'metodepembayaranPDF']);
    Route::get('metodepembayaran-excel', [MetodePembayaranController::class,'metodepembayaranExcel']);

    Route::resource('testimoni',TestimoniAdminController::class);
    Route::get('testimoni-pdf', [TestimoniAdminController::class,'testimoniPDF']);
    Route::get('testimoni-excel', [TestimoniAdminController::class,'testimoniExcel']);
});

// Route::get('/administrator', function () {
//     return view('admin.index');
// });
Route::resource('dashboard',DashboardController::class)->middleware('auth');

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/after_register', function () {
    return view('Admin.after_register');
});

Route::get('/access-denied', function () {
    return view('Admin.access_denied');
})->middleware('auth');

Route::resource('kelola_user',UserssController::class)->middleware('peran:Admin');
Route::get('kelola_user-pdf', [UserssController::class,'kelola_userPDF'])->middleware('peran:Admin');
Route::get('kelola_user-excel', [UserssController::class,'kelola_userExcel'])->middleware('peran:Admin');

Route::resource('pesan-menu',PesanMenuController::class)->middleware('auth');
// Route::get('pesanan-edit/{id}', [PesananController::class,'edit']);
// Route::get('pesanan-pdf', [PesanMenuController::class,'pesananPDF'])->middleware('auth');
// Route::get('pesanan-excel', [PesanMenuController::class,'pesananExcel'])->middleware('auth');

//----Rest API-----
Route::get('/api-menu', [MenuController::class, 'apiMenu']);
Route::get('/api-menu/{id}', [MenuController::class, 'apiMenuDetail']);

Route::resource('menupelanggan',UserMenuController::class);

// Route::resource('testimoni',TestimoniController::class)->middleware('auth');

Route::resource('testi_user',TestimoniController::class)->middleware('auth');

// Route::get('kirimtesti', [App\Http\Controllers\TestimoniController::class, 'create'])->middleware('auth');
Route::get('pesan', [App\Http\Controllers\UserMenuController::class, 'create'])->middleware('auth');
Route::get('testi', [App\Http\Controllers\TestimoniController::class, 'index']);
Route::get('blog', [App\Http\Controllers\BlogController::class, 'index']);

Route::resource('Home',MasterController::class);


// Route::get('/cart', function () {
//     return view('User.checkout');
// });

Route::resource('cart',UserPesananController::class)->middleware('auth');
Route::post('add-cart', [CartController::class, 'store'])->name('add.to.cart')->middleware('auth');
// Route::resource('pesan-menu',UserPesanController::class)->middleware('auth');
Route::resource('bayar',UserBayarController::class)->middleware('auth');
Route::get('bayar-pdf', [UserBayarController::class,'bayarPDF'])->middleware('auth');

Route::get('/metode-pembayaran', function () {
    return view('User.metodepembayaran');
});

Route::resource('myprofil',UserCustomerController::class)->middleware('auth');

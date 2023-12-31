<?php


use App\Models\Member;
use App\Models\Produk;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PembelianDetailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('menu_utama',[
        "title" => "Menu Utama"
    ]);
});
Route::get('/about', function () {
    return view('about',[
        "title" => "About"
    ]);
});


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);


Route::get('/dashboard', function() 
{
    return view('dashboard.index',[
        "title" => "Dashboard",
        "active" => "dashboard"
    ]);
})->middleware('auth');

Route::group(['middleware' => 'auth'], function(){
Route::get('/category/data', [CategoryController::class, 'data'])->name('category.data');
Route::post('/category/data', [CategoryController::class, 'store']);
Route::resource('/category', CategoryController::class) ->middleware('auth');

Route::get('/produk/data', [ProdukController::class, 'data'])->name('produk.data');
Route::post('/produk/delete-selected', [ProdukController::class, 'deleteSelected'])->name('produk.delete_selected');
Route::post('/produk/cetak-barcode', [ProdukController::class, 'cetakBarcode'])->name('produk.cetak_barcode');
Route::resource('/produk', ProdukController::class) ->middleware('auth');

Route::get('/member/data', [MemberController::class, 'data'])->name('member.data');
Route::post('/member/cetak-member', [MemberController::class, 'cetakMember'])->name('member.cetak_member');
Route::resource('/member', MemberController::class) ->middleware('auth');

Route::get('/supplier/data', [SupplierController::class, 'data'])->name('supplier.data');
Route::resource('/supplier', SupplierController::class) ->middleware('auth');

Route::get('/pengeluaran/data', [PengeluaranController::class, 'data'])->name('pengeluaran.data');
Route::resource('/pengeluaran', PengeluaranController::class);

Route::get('/pembelian/data', [PembelianController::class, 'data'])->name('pembelian.data');
Route::get('/pembelian/{id}/create', [PembelianController::class, 'create'])->name('pembelian.create');
Route::resource('/pembelian', PembelianController::class)
     ->except('create');

Route::get('/pembelian_detail/{id}/data', [PembelianDetailController::class, 'data'])->name('pembelian_detail.data');
Route::get('/pembelian_detail/loadform/{diskon}/{total}', [PembelianDetailController::class, 'loadForm'])->name('pembelian_detail.load_form');
 Route::resource('/pembelian_detail', PembelianDetailController::class)
      ->except('create', 'show', 'edit');
});





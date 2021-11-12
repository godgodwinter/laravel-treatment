<?php

use App\Http\Controllers\adminapicontroller;
use App\Http\Controllers\admindashboardcontroller;
use App\Http\Controllers\adminprosescontroller;
use App\Http\Controllers\adminseedercontroller;
use App\Http\Controllers\adminsettingscontroller;
use App\Http\Controllers\adminsynccontroller;
use App\Http\Controllers\adminuserscontroller;


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


Route::get('/', function () {
    return view('landing.pages.index');
});


//halaman admin fixed
Route::group(['middleware' => ['auth:web', 'verified']], function() {

    //DASHBOARD-MENU
    Route::get('/dashboard', [admindashboardcontroller::class, 'index'])->name('dashboard');
    //settings
    Route::get('/admin/settings', [adminsettingscontroller::class, 'index'])->name('settings');
    Route::put('/admin/settings/{id}', [adminsettingscontroller::class, 'update'])->name('settings.update');
    Route::put('/admin/seeder/produk', [adminseedercontroller::class, 'produk'])->name('seeder.produk');
    Route::put('/admin/seeder/dokter', [adminseedercontroller::class, 'dokter'])->name('seeder.dokter');
    Route::put('/admin/seeder/treatment', [adminseedercontroller::class, 'treatment'])->name('seeder.treatment');

    //MASTERING
    //USER
    Route::get('/admin/users', [adminuserscontroller::class, 'index'])->name('users');
    Route::get('/admin/users/{id}', [adminuserscontroller::class, 'edit'])->name('users.edit');
    Route::put('/admin/users/{id}', [adminuserscontroller::class, 'update'])->name('users.update');
    Route::delete('/admin/users/{id}', [adminuserscontroller::class, 'destroy'])->name('users.destroy');
    Route::get('/admin/datausers/cari', [adminuserscontroller::class, 'cari'])->name('users.cari');
    Route::get('/admin/datausers/create', [adminuserscontroller::class, 'create'])->name('users.create');
    Route::post('/admin/datausers', [adminuserscontroller::class, 'store'])->name('users.store');
    Route::delete('/admin/datausers/multidel', [adminuserscontroller::class, 'multidel'])->name('users.multidel');

    //produk
    Route::get('/admin/produk', [adminprodukcontroller::class, 'index'])->name('produk');
    Route::get('/admin/produk/{id}', [adminprodukcontroller::class, 'edit'])->name('produk.edit');
    Route::put('/admin/produk/{id}', [adminprodukcontroller::class, 'update'])->name('produk.update');
    Route::delete('/admin/produk/{id}', [adminprodukcontroller::class, 'destroy'])->name('produk.destroy');
    Route::get('/admin/dataproduk/cari', [adminprodukcontroller::class, 'cari'])->name('produk.cari');
    Route::get('/admin/dataproduk/create', [adminprodukcontroller::class, 'create'])->name('produk.create');
    Route::post('/admin/dataproduk', [adminprodukcontroller::class, 'store'])->name('produk.store');
    Route::delete('/admin/dataproduk/multidel', [adminprodukcontroller::class, 'multidel'])->name('produk.multidel');


    //export
    Route::get('/admin/dataprodukexportmateripokok/{dataajar}', [adminprodukcontroller::class, 'export'])->name('produk.inputnilai.export');
    //import
    Route::post('admin/dataprodukimportmateri/{dataajar}',[adminprodukcontroller::class, 'import'])->name('produk.inpunilai.import');


    // api
    Route::get('/api/admin/inputnilai/store/{dataajar}', [adminapicontroller::class, 'inputnilaistore'])->name('api.admin.inputnilai.store');
    Route::get('/api/admin/siswaperkelas/{kelas}', [adminapicontroller::class, 'siswaperkelas'])->name('api.admin.siswaperkelas');
    Route::get('/api/admin/banksoal/periksatingkatkesulitan', [adminapicontroller::class, 'periksatingkatkesulitan'])->name('api.banksoal.periksatingkatkesulitan');

    Route::get('/api/admin/banksoal/kompetensidasargeneratekode/{dataajar}', [adminapicontroller::class, 'kompetensidasargeneratekode'])->name('api.banksoal.kompetensidasargeneratekode');

    //sync
    Route::get('/admin/sync/mapeltodataajar', [adminsynccontroller::class, 'mapeltodataajar'])->name('sync.mapeltodataajar');

    //Seeder
    Route::post('/admin/seeder/kelas', [adminseedercontroller::class, 'kelas'])->name('seeder.kelas');
    Route::post('/admin/seeder/siswa', [adminseedercontroller::class, 'siswa'])->name('seeder.siswa');
    Route::post('/admin/seeder/guru', [adminseedercontroller::class, 'guru'])->name('seeder.guru');
    Route::post('/admin/seeder/mapel', [adminseedercontroller::class, 'mapel'])->name('seeder.mapel');
    Route::post('/admin/seeder/hard', [adminseedercontroller::class, 'hard'])->name('seeder.hard');

    //proseslainlain
    Route::post('/admin/proses/cleartemp', [adminprosescontroller::class, 'cleartemp'])->name('cleartemp');



});

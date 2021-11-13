<?php

use App\Http\Controllers\adminapicontroller;
use App\Http\Controllers\admindashboardcontroller;
use App\Http\Controllers\admindoktercontroller;
use App\Http\Controllers\adminjadwaltreatmentcontroller;
use App\Http\Controllers\adminmembercontroller;
use App\Http\Controllers\adminpenjadwalancontroller;
use App\Http\Controllers\adminprodukcontroller;
use App\Http\Controllers\adminprosescontroller;
use App\Http\Controllers\adminruangancontroller;
use App\Http\Controllers\adminseedercontroller;
use App\Http\Controllers\adminsettingscontroller;
use App\Http\Controllers\adminsynccontroller;
use App\Http\Controllers\admintreatmentcontroller;
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
    Route::get('/admin/seeder/produk', [adminseedercontroller::class, 'produk'])->name('seeder.produk');
    Route::post('/admin/seeder/dokter', [adminseedercontroller::class, 'dokter'])->name('seeder.dokter');
    Route::get('/admin/seeder/treatment', [adminseedercontroller::class, 'treatment'])->name('seeder.treatment');

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


    //treatment
    Route::get('/admin/treatment', [admintreatmentcontroller::class, 'index'])->name('treatment');
    Route::get('/admin/treatment/{id}', [admintreatmentcontroller::class, 'edit'])->name('treatment.edit');
    Route::put('/admin/treatment/{id}', [admintreatmentcontroller::class, 'update'])->name('treatment.update');
    Route::delete('/admin/treatment/{id}', [admintreatmentcontroller::class, 'destroy'])->name('treatment.destroy');
    Route::get('/admin/datatreatment/cari', [admintreatmentcontroller::class, 'cari'])->name('treatment.cari');
    Route::get('/admin/datatreatment/create', [admintreatmentcontroller::class, 'create'])->name('treatment.create');
    Route::post('/admin/datatreatment', [admintreatmentcontroller::class, 'store'])->name('treatment.store');
    Route::delete('/admin/datatreatment/multidel', [admintreatmentcontroller::class, 'multidel'])->name('treatment.multidel');


    //dokter
    Route::get('/admin/dokter', [admindoktercontroller::class, 'index'])->name('dokter');
    Route::get('/admin/dokter/{id}', [admindoktercontroller::class, 'edit'])->name('dokter.edit');
    Route::put('/admin/dokter/{id}', [admindoktercontroller::class, 'update'])->name('dokter.update');
    Route::delete('/admin/dokter/{id}', [admindoktercontroller::class, 'destroy'])->name('dokter.destroy');
    Route::get('/admin/datadokter/cari', [admindoktercontroller::class, 'cari'])->name('dokter.cari');
    Route::get('/admin/datadokter/create', [admindoktercontroller::class, 'create'])->name('dokter.create');
    Route::post('/admin/datadokter', [admindoktercontroller::class, 'store'])->name('dokter.store');
    Route::delete('/admin/datadokter/multidel', [admindoktercontroller::class, 'multidel'])->name('dokter.multidel');


    //member
    Route::get('/admin/member', [adminmembercontroller::class, 'index'])->name('member');
    Route::get('/admin/member/{id}', [adminmembercontroller::class, 'edit'])->name('member.edit');
    Route::put('/admin/member/{id}', [adminmembercontroller::class, 'update'])->name('member.update');
    Route::delete('/admin/member/{id}', [adminmembercontroller::class, 'destroy'])->name('member.destroy');
    Route::get('/admin/datamember/cari', [adminmembercontroller::class, 'cari'])->name('member.cari');
    Route::get('/admin/datamember/create', [adminmembercontroller::class, 'create'])->name('member.create');
    Route::post('/admin/datamember', [adminmembercontroller::class, 'store'])->name('member.store');
    Route::delete('/admin/datamember/multidel', [adminmembercontroller::class, 'multidel'])->name('member.multidel');

    //ruangan
    Route::get('/admin/ruangan', [adminruangancontroller::class, 'index'])->name('ruangan');
    Route::get('/admin/ruangan/{id}', [adminruangancontroller::class, 'edit'])->name('ruangan.edit');
    Route::put('/admin/ruangan/{id}', [adminruangancontroller::class, 'update'])->name('ruangan.update');
    Route::delete('/admin/ruangan/{id}', [adminruangancontroller::class, 'destroy'])->name('ruangan.destroy');
    Route::get('/admin/dataruangan/cari', [adminruangancontroller::class, 'cari'])->name('ruangan.cari');
    Route::get('/admin/dataruangan/create', [adminruangancontroller::class, 'create'])->name('ruangan.create');
    Route::post('/admin/dataruangan', [adminruangancontroller::class, 'store'])->name('ruangan.store');
    Route::delete('/admin/dataruangan/multidel', [adminruangancontroller::class, 'multidel'])->name('ruangan.multidel');


    //jadwaltreatment
    Route::get('/admin/jadwaltreatment', [adminjadwaltreatmentcontroller::class, 'index'])->name('jadwaltreatment');
    Route::get('/admin/jadwaltreatment/{id}', [adminjadwaltreatmentcontroller::class, 'edit'])->name('jadwaltreatment.edit');
    Route::put('/admin/jadwaltreatment/{id}', [adminjadwaltreatmentcontroller::class, 'update'])->name('jadwaltreatment.update');
    Route::delete('/admin/jadwaltreatment/{id}', [adminjadwaltreatmentcontroller::class, 'destroy'])->name('jadwaltreatment.destroy');
    Route::get('/admin/datajadwaltreatment/cari', [adminjadwaltreatmentcontroller::class, 'cari'])->name('jadwaltreatment.cari');
    Route::get('/admin/datajadwaltreatment/create', [adminjadwaltreatmentcontroller::class, 'create'])->name('jadwaltreatment.create');
    Route::post('/admin/datajadwaltreatment', [adminjadwaltreatmentcontroller::class, 'store'])->name('jadwaltreatment.store');
    Route::delete('/admin/datajadwaltreatment/multidel', [adminjadwaltreatmentcontroller::class, 'multidel'])->name('jadwaltreatment.multidel');



    //penjadwalan
    Route::get('/admin/penjadwalan', [adminpenjadwalancontroller::class, 'index'])->name('penjadwalan');
    Route::get('/admin/penjadwalan/{id}', [adminpenjadwalancontroller::class, 'edit'])->name('penjadwalan.edit');
    Route::put('/admin/penjadwalan/{id}', [adminpenjadwalancontroller::class, 'update'])->name('penjadwalan.update');
    Route::delete('/admin/penjadwalan/{id}', [adminpenjadwalancontroller::class, 'destroy'])->name('penjadwalan.destroy');
    Route::get('/admin/datapenjadwalan/cari', [adminpenjadwalancontroller::class, 'cari'])->name('penjadwalan.cari');
    Route::get('/admin/datapenjadwalan/create', [adminpenjadwalancontroller::class, 'create'])->name('penjadwalan.create');
    Route::post('/admin/datapenjadwalan', [adminpenjadwalancontroller::class, 'store'])->name('penjadwalan.store');
    Route::delete('/admin/datapenjadwalan/multidel', [adminpenjadwalancontroller::class, 'multidel'])->name('penjadwalan.multidel');


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

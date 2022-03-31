<?php

use App\Http\Controllers\adminapicontroller;
use App\Http\Controllers\admindashboardcontroller;
use App\Http\Controllers\admindoktercontroller;
use App\Http\Controllers\adminjadwaltreatmentcontroller;
use App\Http\Controllers\adminmembercontroller;
use App\Http\Controllers\adminpenjadwalancontroller;
use App\Http\Controllers\adminperawatancontroller;
use App\Http\Controllers\adminprodukcontroller;
use App\Http\Controllers\adminprosescontroller;
use App\Http\Controllers\adminruangancontroller;
use App\Http\Controllers\adminseedercontroller;
use App\Http\Controllers\adminsettingscontroller;
use App\Http\Controllers\adminsynccontroller;
use App\Http\Controllers\admintestimonicontroller;
use App\Http\Controllers\admintransaksicontroller;
use App\Http\Controllers\admintreatmentcontroller;
use App\Http\Controllers\adminuserscontroller;
use App\Http\Controllers\invoicecontroller;
use App\Http\Controllers\landingcontroller;
use App\Http\Controllers\memberchatcontroller;
use App\Http\Controllers\memberinvoicecontroller;
use App\Http\Controllers\memberjadwalcontroller;
use App\Http\Controllers\memberkeranjangcontroller;
use App\Http\Controllers\membertestimonicontroller;
use App\Http\Controllers\membertransaksicontroller;
use App\Http\Controllers\smscontroller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// use Facades\Yugo\SMSGateway\Interfaces\SMS;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


Route::get('/', [landingcontroller::class, 'index']);
// Route::get('/', function () {

//     return view('landing.pages.index');
// });


Route::get('/sms', [smscontroller::class, 'index'])->name('sms');


//halaman admin fixed
Route::group(['middleware' => ['auth:web', 'verified']], function() {

    //DASHBOARD-MENU
    Route::get('/dashboard', [admindashboardcontroller::class, 'index'])->name('dashboard');
    //settings
    Route::get('/admin/settings', [adminsettingscontroller::class, 'index'])->name('settings');
    Route::put('/admin/settings/{id}', [adminsettingscontroller::class, 'update'])->name('settings.update');
    Route::post('/admin/updatereminder', [adminsettingscontroller::class, 'updatereminder'])->name('settings.reminder');
    Route::get('/admin/seeder/produk', [adminseedercontroller::class, 'produk'])->name('seeder.produk');
    Route::post('/admin/seeder/dokter', [adminseedercontroller::class, 'dokter'])->name('seeder.dokter');
    Route::get('/admin/seeder/treatment', [adminseedercontroller::class, 'treatment'])->name('seeder.treatment');
    Route::get('/admin/reminder/remindersms', [smscontroller::class, 'remindersms'])->name('reminder.remindersms');

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
    Route::get('/admin/datamember/periksachat/{member}', [adminmembercontroller::class, 'periksachat'])->name('member.periksachat');
    Route::post('/admin/datamember/periksachatstore/{member}', [adminmembercontroller::class, 'periksachatstore'])->name('member.adminchat.store');
    Route::delete('/admin/datamember/periksachatdestroy/{id}/{member}', [adminmembercontroller::class, 'periksachatdestroy'])->name('member.periksachat.destroy');

    //testimoni
    Route::get('/admin/testimoni', [admintestimonicontroller::class, 'index'])->name('testimoni');
    Route::delete('/admin/testimoni/{id}', [admintestimonicontroller::class, 'destroy'])->name('testimoni.destroy');
    Route::get('/admin/datatestimoni/cari', [admintestimonicontroller::class, 'cari'])->name('testimoni.cari');
    Route::get('/admin/datatestimoni/status/{id}', [admintestimonicontroller::class, 'status'])->name('testimoni.status');
    Route::delete('/admin/datatestimoni/multidel', [admintestimonicontroller::class, 'multidel'])->name('testimoni.multidel');
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
    Route::delete('/admin/jadwaltreatment/{id}', [adminjadwaltreatmentcontroller::class, 'destroyjam'])->name('jadwaltreatment.destroyjam');
    Route::post('/admin/datjadwaltreatment', [adminjadwaltreatmentcontroller::class, 'storejam'])->name('jadwaltreatment.storejam');


    //perawatan
    Route::get('/admin/perawatan', [adminperawatancontroller::class, 'index'])->name('perawatan');
    Route::get('/admin/dataperawatan/cetak/{blnthn}', [adminperawatancontroller::class, 'cetakblnthn'])->name('perawatan.cetak.blnthn');
    Route::get('/admin/perawatan/{id}', [adminperawatancontroller::class, 'edit'])->name('perawatan.edit');
    Route::put('/admin/perawatan/{id}', [adminperawatancontroller::class, 'update'])->name('perawatan.update');
    Route::delete('/admin/perawatan/{id}', [adminperawatancontroller::class, 'destroy'])->name('perawatan.destroy');
    Route::get('/admin/dataperawatan/cari', [adminperawatancontroller::class, 'cari'])->name('perawatan.cari');
    Route::get('/admin/dataperawatan/create', [adminperawatancontroller::class, 'create'])->name('perawatan.create');
    Route::post('/admin/dataperawatan', [adminperawatancontroller::class, 'store'])->name('perawatan.store');
    Route::delete('/admin/dataperawatan/multidel', [adminperawatancontroller::class, 'multidel'])->name('perawatan.multidel');
    Route::get('/admin/perawatan/{id}/gantistatus', [adminperawatancontroller::class, 'gantistatus'])->name('perawatan.gantistatus');


    Route::post('/admin/perawatan/{id}', [adminperawatancontroller::class, 'tambahjadwal'])->name('perawatan.tambahjadwal');

    //penjadwalan
    Route::get('/admin/penjadwalan', [adminpenjadwalancontroller::class, 'index'])->name('penjadwalan');

    //transaksi
    Route::get('/admin/transaksi', [admintransaksicontroller::class, 'index'])->name('transaksi');
    Route::get('/admin/transaksi/create', [admintransaksicontroller::class, 'create'])->name('transaksi.create');
    Route::get('/createtest', [admintransaksicontroller::class, 'createtest'])->name('transaksi.createtest');
    Route::get('/admin/datatransaksi/cari', [admintransaksicontroller::class, 'cari'])->name('transaksi.cari');
    Route::get('/admin/transaksi/cari', [admintransaksicontroller::class, 'cariproduk'])->name('transaksi.produk.cari');
    Route::post('/admin/datatransaksi/checkout', [admintransaksicontroller::class, 'checkout'])->name('transaksi.checkout');
    Route::delete('/admin/transaksi/{id}', [admintransaksicontroller::class, 'destroy'])->name('transaksi.destroy');
    Route::delete('/admin/datatransaksi/multidel', [admintransaksicontroller::class, 'multidel'])->name('transaksi.multidel');
    Route::get('/admin/datatransaksi/cetak/{blnthn}', [admintransaksicontroller::class, 'cetakblnthn'])->name('transaksi.cetak.blnthn');


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
    Route::post('/admin/seeder/member', [adminseedercontroller::class, 'member'])->name('seeder.member');
    Route::post('/admin/seeder/jadwaltreatment', [adminseedercontroller::class, 'jadwaltreatment'])->name('seeder.jadwaltreatment');
    Route::post('/admin/seeder/kelas', [adminseedercontroller::class, 'kelas'])->name('seeder.kelas');
    Route::post('/admin/seeder/siswa', [adminseedercontroller::class, 'siswa'])->name('seeder.siswa');
    Route::post('/admin/seeder/guru', [adminseedercontroller::class, 'guru'])->name('seeder.guru');
    Route::post('/admin/seeder/mapel', [adminseedercontroller::class, 'mapel'])->name('seeder.mapel');
    Route::post('/admin/seeder/hard', [adminseedercontroller::class, 'hard'])->name('seeder.hard');

    //proseslainlain
    Route::post('/admin/proses/cleartemp', [adminprosescontroller::class, 'cleartemp'])->name('cleartemp');

    // Route::get('sms/send', function (){
    //     return SMS::send(['085736863399'], 'Hello, world!');
    // });


    // member
    //testimoni
    Route::get('/member/testimoni', [membertestimonicontroller::class, 'index'])->name('member.testimoni');
    Route::post('/member/testimoni/store', [membertestimonicontroller::class, 'store'])->name('member.testimoni.store');
    //jadwal
    Route::get('/member/jadwal', [memberjadwalcontroller::class, 'index'])->name('member.jadwal');
    Route::get('/member/chat', [memberchatcontroller::class, 'index'])->name('member.chat');
    Route::post('/member/chat/store', [memberchatcontroller::class, 'store'])->name('member.chat.store');
    Route::delete('/member/chatdetaildestroy/{id}/{member}', [memberchatcontroller::class, 'chatdetaildestroy'])->name('member.chatdetail.destroy');
    //invoice
    Route::get('/member/invoice', [memberinvoicecontroller::class, 'index'])->name('member.invoice');

    //keranjang
    Route::get('/member/keranjang', [memberkeranjangcontroller::class, 'index'])->name('member.keranjang');

    //transaksi
    Route::get('/member/transaksi', [membertransaksicontroller::class, 'index'])->name('member.transaksi');

});


Route::get('/invoice/{id}', [invoicecontroller::class, 'invoice'])->name('transaksi.cetak.invoice');

Route::get('/produk', [landingcontroller::class, 'produk'])->name('landing.produk');
Route::get('/produkdetail/{id}', [landingcontroller::class, 'produkdetail'])->name('landing.produkdetail');


Route::get('/treatment', [landingcontroller::class, 'treatment'])->name('landing.treatment');
Route::get('/treatmentdetail/{id}', [landingcontroller::class, 'treatmentdetail'])->name('landing.treatmentdetail');


Route::get('/dokter', [landingcontroller::class, 'dokter'])->name('landing.dokter');
Route::get('/dokterdetail/{id}', [landingcontroller::class, 'dokterdetail'])->name('landing.dokterdetail');


Route::get('/jadwal', [landingcontroller::class, 'jadwal'])->name('landing.jadwal');


Route::get('/testimoni', [landingcontroller::class, 'testimoni'])->name('landing.testimoni');
Route::post('/testimonistore', [landingcontroller::class, 'testimonistore'])->name('landing.testimoni.store');

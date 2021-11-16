<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\dokter;
use App\Models\kategori;
use App\Models\member;
use App\Models\produk;
use App\Models\testimoni;
use App\Models\treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class landingcontroller extends Controller
{
    public function index(){
        $pages='beranda';
        $jmlproduk=produk::count();
        $jmltreatment=treatment::count();
        $jmldokter=dokter::count();
        $jmlmember=member::count();
        $testimoni=testimoni::with('member')->get();
    return view('landing.pages.index',compact('jmlproduk','jmltreatment','jmldokter','jmlmember','pages','testimoni'));
    }

    public function produk(){
        $pages='produk';
        $datas=produk::paginate(9);
    return view('landing.pages.produk',compact('datas','pages'));
    }

    public function produkdetail(Request $request,produk $id){
        $pages='produk';
        $datas=$id;
    return view('landing.pages.produkdetail',compact('datas','pages'));
    }

    public function treatment(){
        $pages='treatment';
        $datas=treatment::paginate(9);
    return view('landing.pages.treatment',compact('datas','pages'));
    }
    public function treatmentdetail(Request $request,treatment $id){
        $pages='treatment';
        $datas=$id;
    return view('landing.pages.treatmentdetail',compact('datas','pages'));
    }




    public function dokter(){
        $pages='dokter';
        $pages='treatment';
        $datas=dokter::paginate(9);
    return view('landing.pages.dokter',compact('datas','pages'));
    }

    public function dokterdetail(Request $request,dokter $id){
        $pages='dokter';
        $datas=$id;
    return view('landing.pages.dokterdetail',compact('datas','pages'));
    }

    public function jadwal(){
        $pages='jadwal';
        $arrHari=kategori::where('prefix','hari')->get();
        $arrJam=[];
        $arrRuangan=kategori::where('prefix','ruangan')->pluck('nama');
        $ruang=kategori::where('prefix','ruangan')->get();
        $collection = new Collection();
        foreach($arrHari as $data){
            // dd($arr);
            $arrJam=kategori::where('prefix','jam')->where('kode',$data->id)->get();
            $collection->push((object)['hari' => $data->nama,
                                        'id' => $data->id,
                                        'jam' => $arrJam,
                                        'ruangan' => $arrRuangan,
            ]);
        }
        $datas=$collection;

        // dd($datas);
    return view('landing.pages.jadwal',compact('datas','pages','ruang'));
    }
    public function testimoni(){
        $pages='testimoni';
        $jmlproduk=produk::count();
        $jmltreatment=treatment::count();
        $jmldokter=dokter::count();
        $jmlmember=member::count();
    return view('landing.pages.produk',compact('jmlproduk','jmltreatment','jmldokter','jmlmember','pages'));
    }
}

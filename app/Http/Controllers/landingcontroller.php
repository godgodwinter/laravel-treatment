<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\dokter;
use App\Models\member;
use App\Models\produk;
use App\Models\treatment;
use Illuminate\Http\Request;

class landingcontroller extends Controller
{
    public function index(){
        $pages='beranda';
        $jmlproduk=produk::count();
        $jmltreatment=treatment::count();
        $jmldokter=dokter::count();
        $jmlmember=member::count();
    return view('landing.pages.index',compact('jmlproduk','jmltreatment','jmldokter','jmlmember','pages'));
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
        $datas=member::count();
    return view('landing.pages.jadwal',compact('datas','pages'));
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

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
        $datas=produk::paginate(Fungsi::paginationjml());
    return view('landing.pages.produk',compact('datas','pages'));
    }


    public function treatment(){
        $pages='treatment';
        $jmlproduk=produk::count();
        $jmltreatment=treatment::count();
        $jmldokter=dokter::count();
        $jmlmember=member::count();
    return view('landing.pages.produk',compact('jmlproduk','jmltreatment','jmldokter','jmlmember','pages'));
    }


    public function member(){
        $pages='member';
        $jmlproduk=produk::count();
        $jmltreatment=treatment::count();
        $jmldokter=dokter::count();
        $jmlmember=member::count();
    return view('landing.pages.produk',compact('jmlproduk','jmltreatment','jmldokter','jmlmember','pages'));
    }


    public function dokter(){
        $pages='dokter';
        $jmlproduk=produk::count();
        $jmltreatment=treatment::count();
        $jmldokter=dokter::count();
        $jmlmember=member::count();
    return view('landing.pages.produk',compact('jmlproduk','jmltreatment','jmldokter','jmlmember','pages'));
    }

    public function jadwal(){
        $pages='jadwal';
        $jmlproduk=produk::count();
        $jmltreatment=treatment::count();
        $jmldokter=dokter::count();
        $jmlmember=member::count();
    return view('landing.pages.produk',compact('jmlproduk','jmltreatment','jmldokter','jmlmember','pages'));
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

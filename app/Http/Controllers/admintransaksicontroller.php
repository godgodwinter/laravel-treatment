<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\member;
use App\Models\produk;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class admintransaksicontroller extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->tipeuser!='admin'){
                return redirect()->route('dashboard')->with('status','Halaman tidak ditemukan!')->with('tipe','danger');
            }

        return $next($request);

        });
    }
    public function index(Request $request)
    {
        #WAJIB
        $pages='transaksi';
        $datas=transaksi::with('member')->orderBy('tgl','desc')
        ->paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.transaksi.index',compact('datas','request','pages'));
    }
    public function create(Request $request)
    {
        #WAJIB
        $pages='transaksi';
        $datas=produk::paginate(Fungsi::paginationjml());
        $member=member::get();
        // dd($produk);

        return view('pages.admin.transaksi.create',compact('datas','request','pages','member'));
    }
    public function cariproduk(Request $request)
    {

        $cari=$request->cari;
        #WAJIB
        $pages='transaksi';
        $datas=produk::where('nama','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());
        $member=member::get();
        // dd($datas);

        return view('pages.admin.transaksi.create',compact('datas','request','pages','member'));
    }
}

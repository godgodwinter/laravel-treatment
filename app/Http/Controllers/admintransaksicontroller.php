<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
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
        $pages='dokter';
        $datas=transaksi::with('member')->orderBy('tgl','desc')
        ->paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.transaksi.index',compact('datas','request','pages'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\member;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class memberinvoicecontroller extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->tipeuser!='member'){
                return redirect()->route('dashboard')->with('status','Halaman tidak ditemukan!')->with('tipe','danger');
            }

        return $next($request);

        });
    }
    public function index(Request $request)
    {
        $member=member::where('users_id',Auth::user()->id)->first();
        $member_id=$member->id;
        #WAJIB
        $pages='testimoni';
        $datas=transaksi::with('member')->where('member_id',$member_id)
        ->paginate(Fungsi::paginationjml());

        return view('pages.member.invoice.index',compact('datas','request','pages'));
    }
}

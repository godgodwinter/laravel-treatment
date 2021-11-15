<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\member;
use App\Models\testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class membertestimonicontroller extends Controller
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
        $datas=testimoni::with('member')->where('member_id',$member_id)
        ->paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.member.testimoni.index',compact('datas','request','pages'));
    }

    public function store(Request $request)
    {
        $member=member::where('users_id',Auth::user()->id)->first();
        $member_id=$member->id;
        $request->validate([
            'pesan'=>'required',

        ],
        [
            'pesan.required'=>'pesan harus diisi',
        ]);
        $cek=testimoni::where('member_id',$member_id)
        ->count();
            if($cek>0){
                testimoni::where('member_id',$member_id)
                ->update([
                    'pesan'     =>   $request->pesan,
                    'status'     =>   'hidden',
                    'tgl'     =>   date("Y-m-d"),
                   'updated_at'=>date("Y-m-d H:i:s")
                ]);


            }else{
                $data_id=DB::table('testimoni')->insertGetId(
                    array(
                           'pesan'     =>   $request->pesan,
                           'member_id'     =>   $member_id,
                           'status'     =>   'hidden',
                           'tgl'     =>   date("Y-m-d"),
                           'created_at'=>date("Y-m-d H:i:s"),
                           'updated_at'=>date("Y-m-d H:i:s")
                    ));

            }




    return redirect()->route('member.testimoni')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }
}

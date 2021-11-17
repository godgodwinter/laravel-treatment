<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\chat;
use App\Models\member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class memberchatcontroller extends Controller
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
        $pages='chat';
        $datas=chat::with('member')->with('chatdetail')->with('users')->where('member_id',$member_id)
        ->paginate(Fungsi::paginationjml());

        return view('pages.member.chat.index',compact('datas','request','pages'));
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
        $cek=chat::where('member_id',$member_id)
        ->count();
            if($cek>0){
                $ambildata=chat::where('member_id',$member_id)
                ->first();
                $chat_id=$ambildata->id;
                chat::where('member_id',$member_id)
                ->update([
                   'updated_at'=>date("Y-m-d H:i:s")
                ]);


            }else{
                $chat_id=DB::table('chat')->insertGetId(
                    array(
                           'member_id'     =>   $member_id,
                           'users_id'     =>   '1', //chat dengan admin
                           'status'     =>   'aktif',
                           'created_at'=>date("Y-m-d H:i:s"),
                           'updated_at'=>date("Y-m-d H:i:s")
                    ));

            }

            DB::table('chatdetail')->insertGetId(
                array(
                       'chat_id'     =>   $chat_id,
                       'users_id'     =>   $member->users->id,
                       'pesan'     =>   $request->pesan,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));






    return redirect()->route('member.chat')->with('status','Pesan berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\member;
use App\Models\penjadwalan;
use App\Models\perawatan;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class memberjadwalcontroller extends Controller
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
        $pages='jadwal';
            $datapenjadwalan = new Collection();
        $perawatan=perawatan::with('member')->with('treatment')->where('member_id',$member_id)
        ->get();
        $datas=$perawatan;

        return view('pages.member.jadwal.index',compact('datas','request','pages'));
//         dd($perawatan);
//         foreach($perawatan as $item){
//             $jml=penjadwalan::with('perawatan')->where('perawatan_id',$item->id)->count();
//             $getdata=(object) array(
//                 'perawatan' => null,
//                 'tgl' => null,
//                 'jam' => null,
//                 'ruangan' => null,
//                 'status' => null,
//             );
//             if($jml>0){
//                 $getdata=penjadwalan::with('perawatan')->where('perawatan_id',$item->id)->first();
//             }

//             // dd($getdata);

//             $datapenjadwalan->push((object)$getdata
// );
//             // dd($datapenjadwalan,$getdata);
//         }
//         // foreach($datapenjadwalan as $j){
//         //     dd($j->perawatan);
//         // }
//         $datas=$datapenjadwalan->sortBy('tgl')->sortBy('jam');
//         // dd($datapenjadwalan);
//         // dd($datapenjadwalan,$datapenjadwalan[0]->tgl);

//         return view('pages.member.jadwal.index',compact('datas','request','pages'));
    }

}

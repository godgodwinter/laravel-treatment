<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\jadwaltreatment;
use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class adminjadwaltreatmentcontroller extends Controller
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
        $pages='jadwaltreatment';
        // $datas=jadwaltreatment::paginate(Fungsi::paginationjml());
        $arrHari=kategori::where('prefix','hari')->get();
        $arrJam=[];
        $arrRuangan=kategori::where('prefix','ruangan')->pluck('nama');
        $collection = new Collection();
        foreach($arrHari as $data){
            // dd($arr);

            $arrJam=kategori::where('prefix','jam')->where('kode',$data->id)->pluck('nama');

            $collection->push((object)['hari' => $data->nama,
                                        'id' => $data->id,
                                        'jam' => $arrJam,
                                        'ruangan' => $arrRuangan,
            ]);
        }
        $datas=$collection;
        // dd($collection);

        return view('pages.admin.jadwaltreatment.index',compact('datas','request','pages'));
    }
}

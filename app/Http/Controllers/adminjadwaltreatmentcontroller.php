<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\jadwaltreatment;
use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

            $arrJam=kategori::where('prefix','jam')->where('kode',$data->id)->get();

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
    public function destroyjam(kategori $id){
        // dd($id);
        kategori::destroy($id->id);
        return redirect()->route('jadwaltreatment')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
    public function storejam(Request $request)
    {
        $originalDate = $request->nama;
$newDate = date("H:i:s", strtotime($originalDate));

        // dd($originalDate,$newDate);
        $cek=kategori::where('nama',$request->nama)
        ->where('prefix','jam')
        ->where('kode',$request->kode)
        ->count();

        if($cek>0){
            return  redirect()->route('jadwaltreatment')->with('status','Gagal, Jam sudah ada pada hari tersebut!')->with('tipe','error')->with('icon','fas fa-feather');
        }

            $request->validate([
                'nama'=>'required',

            ],
            [
                'nama.nama'=>'nama harus diisi',
            ]);

            DB::table('kategori')->insert(
                array(
                       'nama'     =>   $newDate,
                       'prefix'     =>   'jam',
                       'kode'     =>   $request->kode,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));



    return redirect()->route('jadwaltreatment')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }
}

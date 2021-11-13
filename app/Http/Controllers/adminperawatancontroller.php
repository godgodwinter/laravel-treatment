<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\dokter;
use App\Models\kategori;
use App\Models\member;
use App\Models\perawatan;
use App\Models\treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class adminperawatancontroller extends Controller
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
        $pages='perawatan';
        $dokter=dokter::get();
        $ruangan=kategori::where('prefix','ruangan')->get();

        $jam=kategori::where('prefix','jam')->where('kode','2')->get();
        // $datas=jadwaltreatment::paginate(Fungsi::paginationjml());
        $datas=perawatan::with('member')->with('treatment')->paginate(Fungsi::paginationjml());


        return view('pages.admin.perawatan.index',compact('datas','request','pages','dokter','ruangan','jam'));
    }
    public function cari(Request $request)
    {

        $cari=$request->cari;
        #WAJIB
        $pages='perawatan';
        $datas=perawatan::where('member','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());



        return view('pages.admin.perawatan.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='perawatan';

        $member=member::get();
        $treatment=treatment::get();
        return view('pages.admin.perawatan.create',compact('pages','member','treatment'));
    }

    public function store(Request $request)
    {

            $request->validate([
                'member_id'=>'required',
                // 'treatment_id'=>'required',
                // 'status'=>'required',
                // 'tglbayar'=>'required',

            ],
            [
                'member_id.nama'=>'nama harus diisi',
            ]);

            DB::table('perawatan')->insert(
                array(
                       'member_id'     =>   $request->member_id,
                       'treatment_id'     =>   $request->treatment_id,
                       'status'     =>   $request->status,
                       'tglbayar'     =>   $request->tglbayar,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));



    return redirect()->route('perawatan')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(perawatan $id)
    {
        $pages='perawatan';
        $member=member::get();
        $treatment=treatment::get();

        return view('pages.admin.perawatan.edit',compact('pages','id','member','treatment'));
    }
    public function update(perawatan $id,Request $request)
    {

        $request->validate([
            'member_id'=>'required',
            'treatment_id'=>'required',
            'status'=>'required',
            'tglbayar'=>'required',

        ],
        [
            'member_id.nama'=>'nama harus diisi',
        ]);


        perawatan::where('id',$id->id)
        ->update([
            'member_id'     =>   $request->member_id,
            'treatment_id'     =>   $request->treatment_id,
            'status'     =>   $request->status,
            'tglbayar'     =>   $request->tglbayar,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);


    return redirect()->route('perawatan')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(perawatan $id){

        perawatan::destroy($id->id);
        return redirect()->route('perawatan')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }

    public function multidel(Request $request)
    {

        $ids=$request->ids;
        perawatan::whereIn('id',$ids)->delete();

        // load ulang
        #WAJIB
        $pages='perawatan';
        $datas=perawatan
        ::paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.perawatan.index',compact('datas','request','pages'));

    }
}

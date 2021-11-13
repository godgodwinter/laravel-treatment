<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class adminruangancontroller extends Controller
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
        $pages='ruangan';
        $datas=kategori::where('prefix','ruangan')
        ->paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.ruangan.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {

        $cari=$request->cari;
        #WAJIB
        $pages='ruangan';
        $datas=kategori::where('nama','like',"%".$cari."%")->where('prefix','ruangan')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.ruangan.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='ruangan';
        $walikategori=DB::table('kategori')->whereNull('deleted_at')->get();
        return view('pages.admin.ruangan.create',compact('pages','walikategori'));
    }

    public function store(Request $request)
    {
        $cek=DB::table('kategori')
        ->where('nama',$request->nama)
        ->where('prefix','ruangan')
        ->count();
            if($cek>0){
                    $request->validate([
                    'nama'=>'required|unique:kategori,nama',
                    ],
                    [
                        'nama.unique'=>'nama sudah digunakan',
                    ]);

            }

            $request->validate([
                'nama'=>'required',

            ],
            [
                'nama.nama'=>'nama harus diisi',
            ]);

            DB::table('kategori')->insert(
                array(
                       'nama'     =>   $request->nama,
                       'prefix'     =>   'ruangan',
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));



    return redirect()->route('ruangan')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(kategori $id)
    {
        $pages='ruangan';

        return view('pages.admin.ruangan.edit',compact('pages','id'));
    }
    public function update(kategori $id,Request $request)
    {

        if($request->nama!==$id->nama){

            $request->validate([
                'nama' => "required",
            ],
            [
            ]);
        }


        $request->validate([
            'nama'=>'required',
            // 'harga'=>'required|integer|min:1',

        ],
        [
            'nama.nama'=>'nama harus diisi',
        ]);


        kategori::where('id',$id->id)->where('prefix','ruangan')
        ->update([
            'nama'     =>   $request->nama,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);


    return redirect()->route('ruangan')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(kategori $id){

        kategori::destroy($id->id);
        return redirect()->route('ruangan')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }

    public function multidel(Request $request)
    {

        $ids=$request->ids;
        kategori::whereIn('id',$ids)->delete();

        // load ulang
        #WAJIB
        $pages='kategori';
        $datas=kategori::where('prefix','ruangan')
        ->paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.ruangan.index',compact('datas','request','pages'));

    }
}

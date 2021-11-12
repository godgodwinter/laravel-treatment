<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class adminprodukcontroller extends Controller
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
        $pages='produk';
        $datas=produk
        ::paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.produk.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {

        $cari=$request->cari;
        #WAJIB
        $pages='produk';
        $datas=produk::where('nama','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.produk.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='produk';
        $waliproduk=DB::table('produk')->whereNull('deleted_at')->get();
        return view('pages.admin.produk.create',compact('pages','waliproduk'));
    }

    public function store(Request $request)
    {
        $cek=DB::table('produk')
        ->where('nama',$request->nama)
        ->count();
            if($cek>0){
                    $request->validate([
                    'nama'=>'required|unique:produk,nama',
                    ],
                    [
                        'nama.unique'=>'nama sudah digunakan',
                    ]);

            }

            $request->validate([
                'nama'=>'required',
                'harga'=>'required|integer|min:1',

            ],
            [
                'nama.nama'=>'nama harus diisi',
            ]);

            DB::table('produk')->insert(
                array(
                       'nama'     =>   $request->nama,
                       'harga'     =>   $request->harga,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));



    return redirect()->route('produk')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(produk $id)
    {
        $pages='produk';

        return view('pages.admin.produk.edit',compact('pages','id'));
    }
    public function update(produk $id,Request $request)
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
            'harga'=>'required|integer|min:1',

        ],
        [
            'nama.nama'=>'nama harus diisi',
        ]);


        produk::where('id',$id->id)
        ->update([
            'nama'     =>   $request->nama,
            'harga'     =>   $request->harga,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);


    return redirect()->route('produk')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(produk $id){

        produk::destroy($id->id);
        return redirect()->route('produk')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }

    public function multidel(Request $request)
    {

        $ids=$request->ids;
        produk::whereIn('id',$ids)->delete();

        // load ulang
        #WAJIB
        $pages='produk';
        $datas=produk
        ::paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.produk.index',compact('datas','request','pages'));

    }

}

<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class admintestimonicontroller extends Controller
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
        $pages='testimoni';
        $datas=testimoni::with('member')
        ->paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.testimoni.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {

        $cari=$request->cari;
        #WAJIB
        $pages='testimoni';
        $datas=testimoni::with('member')->where('pesan','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.testimoni.index',compact('datas','request','pages'));
    }
    public function status(testimoni $id,Request $request)
    {
        if($id->status=='ok'){
            $status='hidden';
        }else{
            $status='ok';
        }
        testimoni::where('id',$id->id)
        ->update([
            'status'     =>   $status,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);

    return redirect()->route('testimoni')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function update(testimoni $id,Request $request)
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


        testimoni::where('id',$id->id)
        ->update([
            'nama'     =>   $request->nama,
            'harga'     =>   $request->harga,
            'stok'     =>   $request->stok,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);

        $files = $request->file('files');


        if($files!=null){


            // dd('storage'.'/'.$id->sekolah_logo);
            $namafilebaru=$id->id;
            $tujuan_upload = 'storage/testimoni';
                    // upload file
            $files->move($tujuan_upload,"testimoni/".$namafilebaru.".jpg");

            $photo="testimoni/".$namafilebaru.".jpg";


            testimoni::where('id',$id->id)
            ->update([
                'photo'     =>   $photo,
            'updated_at'=>date("Y-m-d H:i:s")
            ]);
        }


    return redirect()->route('testimoni')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(testimoni $id){

        testimoni::destroy($id->id);
        return redirect()->route('testimoni')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }

    public function multidel(Request $request)
    {

        $ids=$request->ids;
        testimoni::whereIn('id',$ids)->delete();

        // load ulang
        #WAJIB
        $pages='testimoni';
        $datas=testimoni
        ::paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.testimoni.index',compact('datas','request','pages'));

    }
}

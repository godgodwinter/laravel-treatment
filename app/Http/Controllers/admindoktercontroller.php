<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class admindoktercontroller extends Controller
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
        $pages='dokter';
        $datas=dokter
        ::paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.dokter.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {

        $cari=$request->cari;
        #WAJIB
        $pages='dokter';
        $datas=dokter::where('nama','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.dokter.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='dokter';
        $walidokter=DB::table('dokter')->whereNull('deleted_at')->get();
        return view('pages.admin.dokter.create',compact('pages','walidokter'));
    }

    public function store(Request $request)
    {
        $cek=DB::table('dokter')
        ->where('nama',$request->nama)
        ->count();
            if($cek>0){
                    $request->validate([
                    'nama'=>'required|unique:dokter,nama',
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

            $data_id=DB::table('dokter')->insertGetId(
                array(
                       'nama'     =>   $request->nama,
                       'jk'     =>   $request->jk,
                       'telp'     =>   $request->telp,
                       'spesialisasi'     =>   $request->spesialisasi,
                       'tgllahir'     =>   $request->tgllahir,
                       'alamat'     =>   $request->alamat,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));

                $files = $request->file('files');


                if($files!=null){


                    // dd('storage'.'/'.$id->sekolah_logo);
                    $namafilebaru=$data_id;
                    $tujuan_upload = 'storage/dokter';
                            // upload file
                    $files->move($tujuan_upload,"dokter/".$namafilebaru.".jpg");

                    $photo="dokter/".$namafilebaru.".jpg";


                    dokter::where('id',$data_id)
                    ->update([
                        'photo'     =>   $photo,
                    'updated_at'=>date("Y-m-d H:i:s")
                    ]);
                }



    return redirect()->route('dokter')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(dokter $id)
    {
        $pages='dokter';

        return view('pages.admin.dokter.edit',compact('pages','id'));
    }
    public function update(dokter $id,Request $request)
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


        dokter::where('id',$id->id)
        ->update([
            'nama'     =>   $request->nama,
            'jk'     =>   $request->jk,
            'telp'     =>   $request->telp,
            'spesialisasi'     =>   $request->spesialisasi,
            'tgllahir'     =>   $request->tgllahir,
            'alamat'     =>   $request->alamat,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);


        $files = $request->file('files');


        if($files!=null){


            // dd('storage'.'/'.$id->sekolah_logo);
            $namafilebaru=$id->id;
            $tujuan_upload = 'storage/dokter';
                    // upload file
            $files->move($tujuan_upload,"dokter/".$namafilebaru.".jpg");

            $photo="dokter/".$namafilebaru.".jpg";


            dokter::where('id',$id->id)
            ->update([
                'photo'     =>   $photo,
            'updated_at'=>date("Y-m-d H:i:s")
            ]);
        }


    return redirect()->route('dokter')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(dokter $id){

        dokter::destroy($id->id);
        return redirect()->route('dokter')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }

    public function multidel(Request $request)
    {

        $ids=$request->ids;
        dokter::whereIn('id',$ids)->delete();

        // load ulang
        #WAJIB
        $pages='dokter';
        $datas=dokter
        ::paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.dokter.index',compact('datas','request','pages'));

    }
}

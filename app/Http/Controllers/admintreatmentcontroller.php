<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class admintreatmentcontroller extends Controller
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
        $pages='treatment';
        $datas=treatment
        ::paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.treatment.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {

        $cari=$request->cari;
        #WAJIB
        $pages='treatment';
        $datas=treatment::where('nama','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.treatment.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='treatment';
        $walitreatment=DB::table('treatment')->whereNull('deleted_at')->get();
        return view('pages.admin.treatment.create',compact('pages','walitreatment'));
    }

    public function store(Request $request)
    {
        $cek=DB::table('treatment')
        ->where('nama',$request->nama)
        ->count();
            if($cek>0){
                    $request->validate([
                    'nama'=>'required|unique:treatment,nama',
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

            $data_id=DB::table('treatment')->insertGetId(
                array(
                       'nama'     =>   $request->nama,
                       'harga'     =>   $request->harga,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));
                $files = $request->file('files');


                if($files!=null){


                    // dd('storage'.'/'.$id->sekolah_logo);
                    $namafilebaru=$data_id;
                    $tujuan_upload = 'storage/treatment';
                            // upload file
                    $files->move($tujuan_upload,"treatment/".$namafilebaru.".jpg");

                    $photo="treatment/".$namafilebaru.".jpg";


                    treatment::where('id',$data_id)
                    ->update([
                        'photo'     =>   $photo,
                    'updated_at'=>date("Y-m-d H:i:s")
                    ]);
                }


    return redirect()->route('treatment')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(treatment $id)
    {
        $pages='treatment';

        return view('pages.admin.treatment.edit',compact('pages','id'));
    }
    public function update(treatment $id,Request $request)
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


        treatment::where('id',$id->id)
        ->update([
            'nama'     =>   $request->nama,
            'harga'     =>   $request->harga,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);


        $files = $request->file('files');


        if($files!=null){


            // dd('storage'.'/'.$id->sekolah_logo);
            $namafilebaru=$id->id;
            $tujuan_upload = 'storage/treatment';
                    // upload file
            $files->move($tujuan_upload,"treatment/".$namafilebaru.".jpg");

            $photo="treatment/".$namafilebaru.".jpg";


            treatment::where('id',$id->id)
            ->update([
                'photo'     =>   $photo,
            'updated_at'=>date("Y-m-d H:i:s")
            ]);
        }



    return redirect()->route('treatment')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(treatment $id){

        treatment::destroy($id->id);
        return redirect()->route('treatment')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }

    public function multidel(Request $request)
    {

        $ids=$request->ids;
        treatment::whereIn('id',$ids)->delete();

        // load ulang
        #WAJIB
        $pages='treatment';
        $datas=treatment
        ::paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.treatment.index',compact('datas','request','pages'));

    }

}

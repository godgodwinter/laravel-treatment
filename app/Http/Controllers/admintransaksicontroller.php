<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\member;
use App\Models\produk;
use App\Models\transaksi;
use App\Models\transaksidetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use PDF;

class admintransaksicontroller extends Controller
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
        $date=date('Y-m-d');
        $blnthn=date('Y-m');

        $month = date("m",strtotime($date));
        $year = date("Y",strtotime($date));
        $pages='transaksi';
        $datas=transaksi::with('member')
        ->whereMonth('tgl',$month)
        ->whereYear('tgl',$year)
        ->orderBy('tgl','desc')->orderBy('created_at','desc')
        ->paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.transaksi.index',compact('datas','request','pages','blnthn'));
    }
    public function cari(Request $request)
    {

        $blnthn=$request->blnthn;

        $month = date("m",strtotime($blnthn));
        $year = date("Y",strtotime($blnthn));
        $date=date('Y-m-d');

        #WAJIB
        $datas=transaksi::with('member')
        ->whereMonth('tgl',$month)
        ->whereYear('tgl',$year)
        ->orderBy('tgl','desc')->orderBy('created_at','desc')
        ->paginate(Fungsi::paginationjml());

        $pages='transaksi';

        // dd($datas);

        return view('pages.admin.transaksi.index',compact('datas','request','pages','blnthn'));
     }
    public function create(Request $request)
    {
        #WAJIB
        $pages='transaksi';
        $datas=produk::paginate(Fungsi::paginationjml());
        $member=member::get();
        // dd($produk);

        return view('pages.admin.transaksi.create',compact('datas','request','pages','member'));
    }
    public function createtest(Request $request)
    {
        #WAJIB
        $pages='transaksi';
        $datas=produk::paginate(Fungsi::paginationjml());
        $member=member::get();
        // dd($produk);

        return view('pages.admin.transaksi.createtest',compact('datas','request','pages','member'));
    }
    public function cariproduk(Request $request)
    {

        $cari=$request->cari;
        #WAJIB
        $pages='transaksi';
        $datas=produk::where('nama','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());
        $member=member::get();
        // dd($datas);

        return view('pages.admin.transaksi.create',compact('datas','request','pages','member'));
    }
    public function checkout(Request $request)
    {

        $request->validate([
            'member_id'=>'required',
            'produk'=>'required',
            ],
            [
                'member_id.required'=>'member harus diisi',
                'produk.required'=>'produk harus diisi',
            ]);
            $produk=json_decode($request->produk);
            // dd($produk);
            // foreach($produk as $data){
            //     dd(Uuid::uuid4()->toString(),$request,$data->nama);
            // }
            // dd(Uuid::uuid4()->toString(),$request);

        $data_id=DB::table('transaksi')->insertGetId(
            array(
                    'uuid' => Uuid::uuid4()->toString(),
                   'member_id'     =>   $request->member_id,
                   'tgl'     =>   date("Y-m-d"),
                   'status'     =>   'success',
                   'totaltagihan'     =>   $request->totalbayar,
                   'tipe'     =>   'admin',
                   'users_id'     =>   Auth::user()->id,
                   'created_at'=>date("Y-m-d H:i:s"),
                   'updated_at'=>date("Y-m-d H:i:s")
            ));

            foreach($produk as $data){

        DB::table('transaksidetail')->insertGetId(
            array(
                   'transaksi_id'     =>   $data_id,
                   'produk_id'     =>   $data->id,
                   'jml'     =>   $data->jml,
                   'created_at'=>date("Y-m-d H:i:s"),
                   'updated_at'=>date("Y-m-d H:i:s")
            ));


            produk::find($data->id)->decrement('stok',$data->jml);

            }


            return redirect()->route('transaksi')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');


    }

    public function destroy(transaksi $id){

        transaksi::destroy($id->id);
        transaksidetail::where('transaksi_id',$id->id)->delete();
        return redirect()->route('transaksi')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }

    public function multidel(Request $request)
    {

        $ids=$request->ids;
        transaksi::whereIn('id',$ids)->delete();
        transaksidetail::where('transaksi_id',$ids)->delete();

        // load ulang
        #WAJIB
        $date=date('Y-m-d');
        $blnthn=date('Y-m');

        $month = date("m",strtotime($date));
        $year = date("Y",strtotime($date));
        $pages='transaksi';
        $datas=transaksi::with('member')
        ->whereMonth('tgl',$month)
        ->whereYear('tgl',$year)
        ->orderBy('tgl','desc')->orderBy('created_at','desc')
        ->paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.transaksi.index',compact('datas','request','pages','blnthn'));

    }

    public function cetakblnthn($blnthn){
        // dd($blnthn);
        $month = date("m",strtotime($blnthn));
        $year = date("Y",strtotime($blnthn));

        $datas=transaksi::with('member')
        ->whereMonth('tgl',$month)
        ->whereYear('tgl',$year)->paginate(Fungsi::paginationjml());

        $pdf = PDF::loadview('pages.admin.transaksi.cetakblnthn',compact('datas','blnthn'))->setPaper('a4', 'landscape');
        return $pdf->stream('datatransaksi'.$blnthn.'.pdf');
    }

}

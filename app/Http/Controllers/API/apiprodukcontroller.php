<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\dokter;
use App\Models\produk;
use App\Models\testimoni;
use App\Models\treatment;
use Illuminate\Http\Request;

class apiprodukcontroller extends Controller
{
    public function produk(Request $request){
        $id=$request->input('id');
        $limit=$request->input('limit',6);
        $nama=$request->input('nama');
        // $harga=$request->input('harga');
        $price_from=$request->input('price_from');
        $price_to=$request->input('price_to');

        if($id){
            $produk=produk::find($id);

            if($produk)
                return ResponseFormatter::success($produk,'Data berhasil di ambil');
            else
                return ResponseFormatter::success(null,'Data tidak ditemukan',404);

        }

        $produk=produk::with('transaksidetail');
        // if($harga)
        $produk=produk::where('nama','like','%'.$nama.'%');
        // $produk=produk::where('harga','like','%'.$harga.'%')->first();


        if($nama)
        $produk=produk::where('nama','like','%'.$nama.'%');

        if($price_from)
        $produk=produk::where('harga','>=',$price_from)->first();


        if($price_to)
        $produk=produk::where('harga','<=',$price_to)->first();

        return ResponseFormatter::success(
            $produk->paginate($limit),
            'Data berhasil diambil'
        );
    }

    public function treatment(Request $request){
        $id=$request->input('id');
        $limit=$request->input('limit',6);
        $nama=$request->input('nama');
        // $harga=$request->input('harga');
        $price_from=$request->input('price_from');
        $price_to=$request->input('price_to');

        if($id){
            $treatment=treatment::find($id);

            if($treatment)
                return ResponseFormatter::success($treatment,'Data berhasil di ambil');
            else
                return ResponseFormatter::success(null,'Data tidak ditemukan',404);

        }

        $treatment=treatment::with('perawatan');
        // if($harga)
        $treatment=treatment::where('nama','like','%'.$nama.'%');
        // $treatment=treatment::where('harga','like','%'.$harga.'%')->first();


        if($nama)
        $treatment=treatment::where('nama','like','%'.$nama.'%');

        if($price_from)
        $treatment=treatment::where('harga','>=',$price_from)->first();


        if($price_to)
        $treatment=treatment::where('harga','<=',$price_to)->first();

        return ResponseFormatter::success(
            $treatment->paginate($limit),
            'Data berhasil diambil'
        );
    }


    public function dokter(Request $request){
        $id=$request->input('id');
        $limit=$request->input('limit',6);
        $nama=$request->input('nama');
        // $harga=$request->input('harga');
        $spesialisasi=$request->input('spesiali$spesialisasi');
        $jk=$request->input('jk');

        if($id){
            $dokter=dokter::find($id);

            if($dokter)
                return ResponseFormatter::success($dokter,'Data berhasil di ambil');
            else
                return ResponseFormatter::success(null,'Data tidak ditemukan',404);

        }

        $dokter=dokter::with('penjadwalan');
        // if($harga)
        $dokter=dokter::where('nama','like','%'.$nama.'%');
        // $dokter=dokter::where('harga','like','%'.$harga.'%')->first();


        if($nama)
        $dokter=dokter::where('nama','like','%'.$nama.'%');

        if($spesialisasi)
        $dokter=dokter::where('spesialisasi','like','%'.$spesialisasi.'%');


        if($jk)
        $dokter=dokter::where('jk','like','%'.$jk.'%');

        return ResponseFormatter::success(
            $dokter->paginate($limit),
            'Data berhasil diambil'
        );
    }
    public function testimoni(Request $request){
        $id=$request->input('id');
        $limit=$request->input('limit',6);
        $nama=$request->input('nama');

        if($id){
            $testimoni=testimoni::find($id);

            if($testimoni)
                return ResponseFormatter::success($testimoni,'Data berhasil di ambil');
            else
                return ResponseFormatter::success(null,'Data tidak ditemukan',404);

        }

        $testimoni=testimoni::with('member');
        // if($harga)
        $testimoni=testimoni::where('id','like','%'.$id.'%');
        // $dokter=dokter::where('harga','like','%'.$harga.'%')->first();


        // if($nama)
        // $dokter=dokter::where('nama','like','%'.$nama.'%');

        // if($spesialisasi)
        // $dokter=dokter::where('spesialisasi','like','%'.$spesialisasi.'%');


        // if($jk)
        // $dokter=dokter::where('jk','like','%'.$jk.'%');

        return ResponseFormatter::success(
            $testimoni->paginate($limit),
            'Data berhasil diambil'
        );
    }
}

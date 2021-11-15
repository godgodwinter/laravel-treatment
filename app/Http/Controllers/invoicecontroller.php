<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use Illuminate\Http\Request;
use PDF;

class invoicecontroller extends Controller
{
    public function invoice(transaksi $id){
        $datas=transaksi::with('member')->with('transaksidetail')->where('id',$id->id)->first();
        // dd($datas);

        // $datas=transaksi::with('member')->where('id',$id)->paginate(Fungsi::paginationjml());

        $pdf = PDF::loadview('pages.admin.transaksi.invoice',compact('datas'))->setPaper('a4', 'landscape');
        return $pdf->stream('datatransaksi'.$id->uuid.'.pdf');
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\dokter;
use App\Models\kategori;
use App\Models\member;
use App\Models\penjadwalan;
use App\Models\perawatan;
use App\Models\treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class adminperawatancontroller extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->tipeuser != 'admin') {
                return redirect()->route('dashboard')->with('status', 'Halaman tidak ditemukan!')->with('tipe', 'danger');
            }

            return $next($request);
        });
    }
    public function index(Request $request)
    {
        $date = date('Y-m-d');
        $blnthn = date('Y-m');

        $month = date("m", strtotime($date));
        $year = date("Y", strtotime($date));

        #WAJIB
        $pages = 'perawatan';
        $dokter = dokter::get();
        $ruangan = kategori::where('prefix', 'ruangan')->get();
        $namaHari = Fungsi::namaHari($date);
        $periksaHari = kategori::where('nama', $namaHari)->where('prefix', 'hari')->first();
        $idHarisekarang = $periksaHari->id;

        $jam = kategori::where('prefix', 'jam')->where('kode', $idHarisekarang)->get();

        // dd($namaHari,$periksaHari,$idHarisekarang,$jam);
        // $datas=jadwaltreatment::paginate(Fungsi::paginationjml());
        $datas = perawatan::with('member')
            ->whereMonth('tglbayar', $month)
            ->whereYear('tglbayar', $year)
            ->with('treatment')
            ->orderBy('created_at', 'desc')
            ->paginate(Fungsi::paginationjml());
        // dd('tes');

        return view('pages.admin.perawatan.index', compact('datas', 'request', 'pages', 'dokter', 'ruangan', 'jam', 'namaHari', 'blnthn'));
    }
    public function cari(Request $request)
    {

        $blnthn = $request->blnthn;

        $month = date("m", strtotime($blnthn));
        $year = date("Y", strtotime($blnthn));
        $date = date('Y-m-d');

        $dokter = dokter::get();

        $ruangan = kategori::where('prefix', 'ruangan')->get();
        $namaHari = Fungsi::namaHari($date);

        $periksaHari = kategori::where('nama', $namaHari)->where('prefix', 'hari')->first();
        $idHarisekarang = $periksaHari->id;

        $jam = kategori::where('prefix', 'jam')->where('kode', $idHarisekarang)->get();
        // dd($month,$year,$blnthn);
        #WAJIB
        $pages = 'perawatan';
        $datas = perawatan::with('member')
            ->whereMonth('tglbayar', $month)
            ->whereYear('tglbayar', $year)
            ->paginate(Fungsi::paginationjml());

        return view('pages.admin.perawatan.index', compact('datas', 'request', 'pages', 'dokter', 'ruangan', 'jam', 'namaHari', 'blnthn'));
    }
    public function cetakblnthn($blnthn)
    {
        // dd($blnthn);
        $month = date("m", strtotime($blnthn));
        $year = date("Y", strtotime($blnthn));

        $datas = perawatan::with('member')
            ->whereMonth('tglbayar', $month)
            ->whereYear('tglbayar', $year)
            ->with('treatment')->paginate(Fungsi::paginationjml());

        $pdf = PDF::loadview('pages.admin.perawatan.cetakblnthn', compact('datas', 'blnthn'))->setPaper('a4', 'landscape');
        return $pdf->stream('dataperawatan' . $blnthn . '.pdf');
    }
    public function create()
    {
        $pages = 'perawatan';

        $member = member::get();
        $treatment = treatment::get();
        return view('pages.admin.perawatan.create', compact('pages', 'member', 'treatment'));
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'member_id' => 'required',
                // 'treatment_id'=>'required',
                // 'status'=>'required',
                // 'tglbayar'=>'required',

            ],
            [
                'member_id.nama' => 'nama harus diisi',
            ]
        );

        DB::table('perawatan')->insert(
            array(
                'member_id'     =>   $request->member_id,
                'treatment_id'     =>   $request->treatment_id,
                'status'     =>   $request->status,
                'tglbayar'     =>   $request->tglbayar,
                'tglreminder'     =>   $request->tglreminder,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            )
        );



        return redirect()->route('perawatan')->with('status', 'Data berhasil tambahkan!')->with('tipe', 'success')->with('icon', 'fas fa-feather');
    }
    public function gantistatus(perawatan $id)
    {
        $statusbaru = 'Sudah Treatment';
        if ($id->statustreatment == 'Sudah Treatment') {
            $statusbaru = 'Belum Treatment';
        }
        perawatan::where('id', $id->id)
            ->update([
                'statustreatment'     =>   $statusbaru,
                'updated_at' => date("Y-m-d H:i:s")
            ]);

        return redirect()->route('perawatan')->with('status', 'Data berhasil diupdate!')->with('tipe', 'success')->with('icon', 'fas fa-feather');
    }

    public function edit(perawatan $id)
    {
        $pages = 'perawatan';
        $member = member::get();
        $treatment = treatment::get();

        return view('pages.admin.perawatan.edit', compact('pages', 'id', 'member', 'treatment'));
    }
    public function update(perawatan $id, Request $request)
    {

        $request->validate(
            [
                'member_id' => 'required',
                'treatment_id' => 'required',
                'status' => 'required',
                'tglbayar' => 'required',

            ],
            [
                'member_id.nama' => 'nama harus diisi',
            ]
        );


        perawatan::where('id', $id->id)
            ->update([
                'member_id'     =>   $request->member_id,
                'treatment_id'     =>   $request->treatment_id,
                'status'     =>   $request->status,
                'tglbayar'     =>   $request->tglbayar,
                'tglreminder'     =>   $request->tglreminder,
                'updated_at' => date("Y-m-d H:i:s")
            ]);


        return redirect()->route('perawatan')->with('status', 'Data berhasil diubah!')->with('tipe', 'success')->with('icon', 'fas fa-feather');
    }
    public function destroy(perawatan $id)
    {

        perawatan::destroy($id->id);
        penjadwalan::where('perawatan_id', $id->id)->delete();
        return redirect()->route('perawatan')->with('status', 'Data berhasil dihapus!')->with('tipe', 'warning')->with('icon', 'fas fa-feather');
    }

    public function multidel(Request $request)
    {

        $ids = $request->ids;
        perawatan::whereIn('id', $ids)->delete();
        penjadwalan::where('perawatan_id', $ids)->delete();

        // load ulang
        #WAJIB
        $date = date('Y-m-d');
        $blnthn = date('Y-m');

        $month = date("m", strtotime($date));
        $year = date("Y", strtotime($date));

        #WAJIB
        $pages = 'perawatan';
        $dokter = dokter::get();
        $ruangan = kategori::where('prefix', 'ruangan')->get();
        $namaHari = Fungsi::namaHari($date);

        $periksaHari = kategori::where('nama', $namaHari)->where('prefix', 'hari')->first();
        $idHarisekarang = $periksaHari->id;

        $jam = kategori::where('prefix', 'jam')->where('kode', $idHarisekarang)->get();

        // dd($namaHari,$periksaHari,$idHarisekarang,$jam);
        // $datas=jadwaltreatment::paginate(Fungsi::paginationjml());
        $datas = perawatan::with('member')
            ->whereMonth('tglbayar', $month)
            ->whereYear('tglbayar', $year)
            ->with('treatment')->paginate(Fungsi::paginationjml());


        return view('pages.admin.perawatan.index', compact('datas', 'request', 'pages', 'dokter', 'ruangan', 'jam', 'namaHari', 'blnthn'));
    }

    public function tambahjadwal(Request $request, perawatan $id)
    {

        $cekperawatanid = penjadwalan::where('perawatan_id', $id->id)->count();
        if ($cekperawatanid > 0) {
            $ambilpenjadwalanid = penjadwalan::where('perawatan_id', $id->id)->first();
            // dd($ambilpenjadwalanid->id);

            if (($request->tgl == $ambilpenjadwalanid->tgl) and ($request->ruangan == $ambilpenjadwalanid->ruangan) and ($request->jam == $ambilpenjadwalanid->jam)) {
                // dd('update');

                penjadwalan::where('id', $ambilpenjadwalanid->id)
                    ->update([
                        'ruangan'     =>   $request->ruangan,
                        'tgl'     =>   $request->tgl,
                        'jam'     =>   $request->jam,
                        'dokter_id'     =>   $request->dokter_id,
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);

                return redirect()->route('perawatan')->with('status', 'Data berhasil di diubah')->with('tipe', 'success')->with('icon', 'fas fa-feather');
            }
            $cektglruangdanjam = penjadwalan::where('tgl', $request->tgl)
                // ->where('dokter_id',$request->dokter_id)
                ->where('ruangan', $request->ruangan)
                ->where('jam', $request->jam)
                ->count();
            // dd($cektglruangdanjam);

            if ($cektglruangdanjam > 0) {
                return redirect()->route('perawatan')->with('status', 'Gagal! Ruangan, Jam pada Tanggal telah digunakan')->with('tipe', 'error')->with('icon', 'fas fa-feather');
            } else {
                // dd('update');

                penjadwalan::where('id', $ambilpenjadwalanid->id)
                    ->update([
                        'ruangan'     =>   $request->ruangan,
                        'tgl'     =>   $request->tgl,
                        'jam'     =>   $request->jam,
                        'dokter_id'     =>   $request->dokter_id,
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);

                return redirect()->route('perawatan')->with('status', 'Data berhasil di diubah')->with('tipe', 'success')->with('icon', 'fas fa-feather');
            }
        } else {

            $cektglruangdanjam = penjadwalan::where('tgl', $request->tgl)
                // ->where('dokter_id',$request->dokter_id)
                ->where('ruangan', $request->ruangan)
                ->where('jam', $request->jam)
                ->count();
            // dd($cektglruangdanjam);

            if ($cektglruangdanjam > 0) {
                return redirect()->route('perawatan')->with('status', 'Gagal! Ruangan, Jam pada Tanggal telah digunakan')->with('tipe', 'error')->with('icon', 'fas fa-feather');
            } else {

                DB::table('penjadwalan')->insert(
                    array(
                        'perawatan_id'     =>   $id->id,
                        'ruangan'     =>   $request->ruangan,
                        'tgl'     =>   $request->tgl,
                        'jam'     =>   $request->jam,
                        'dokter_id'     =>   $request->dokter_id,
                        'status'     =>   'Belum',
                        'pengingat'     =>   'Aktif',
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s")
                    )
                );

                return redirect()->route('perawatan')->with('status', 'Data berhasil di tambahkan')->with('tipe', 'success')->with('icon', 'fas fa-feather');
            }
        }

        // dd($request,$id);

    }
}

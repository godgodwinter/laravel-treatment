<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\chat;
use App\Models\chatdetail;
use App\Models\member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminmembercontroller extends Controller
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
        $pages='member';
        $datas=member
        ::with('users')->paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.member.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {

        $cari=$request->cari;
        #WAJIB
        $pages='member';
        $datas=member::where('nama','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.member.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='member';
        $walimember=DB::table('member')->whereNull('deleted_at')->get();
        return view('pages.admin.member.create',compact('pages','walimember'));
    }

    public function store(Request $request)
    {

        $cek=DB::table('users')
        // ->whereNull('deleted_at')
        ->where('username',$request->username)
        ->orWhere('email',$request->email)
        ->count();
        // dd($cek);
            if($cek>0){
                    $request->validate([
                    'username'=>'required|unique:users,username',
                    'email'=>'required|unique:users,email',
                    'password' => 'min:3|required_with:password2|same:password2',
                    'password2' => 'min:3',

                    ],
                    [
                        'username.unique'=>'username sudah digunakan',
                    ]);

            }

            $request->validate([
                'nama'=>'required',
                'username'=>'required',
                'password' => 'min:3|required_with:password2|same:password2',
                'password2' => 'min:3',

            ],
            [
                'nama.nama'=>'Nama harus diisi',
            ]);

            // $cek=DB::table('member')
            // ->where('nama',$request->nama)
            // ->count();
            //     if($cek>0){
            //             $request->validate([
            //             'nama'=>'required|unique:member,nama',
            //             ],
            //             [
            //                 'nama.unique'=>'nama sudah digunakan',
            //             ]);

            //     }

                $request->validate([
                    'nama'=>'required',

                ],
                [
                    'nama.nama'=>'nama harus diisi',
                ]);

            $users_id=DB::table('users')->insertGetId(
                array(
                       'name'     =>   $request->nama,
                       'email'     =>   $request->email,
                       'username'     =>   $request->username,
                       'nomerinduk'     => date('YmdHis'),
                       'password' => Hash::make($request->password),
                       'tipeuser' => 'member',
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));



            $data_id=DB::table('member')->insertGetId(
                array(
                       'nama'     =>   $request->nama,
                       'jk'     =>   $request->jk,
                       'telp'     =>   $request->telp,
                       'tgllahir'     =>   $request->tgllahir,
                       'alamat'     =>   $request->alamat,
                       'users_id'     =>   $users_id,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));


                $files = $request->file('files');


                if($files!=null){


                    // dd('storage'.'/'.$id->sekolah_logo);
                    $namafilebaru=$data_id;
                    $tujuan_upload = 'storage/member';
                            // upload file
                    $files->move($tujuan_upload,"member/".$namafilebaru.".jpg");

                    $photo="member/".$namafilebaru.".jpg";


                    member::where('id',$data_id)
                    ->update([
                        'photo'     =>   $photo,
                    'updated_at'=>date("Y-m-d H:i:s")
                    ]);
                }

    return redirect()->route('member')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(member $id)
    {
        $pages='member';

        return view('pages.admin.member.edit',compact('pages','id'));
    }
    public function update(member $id,Request $request)
    {


        if($request->email!==$id->users->email){
            $request->validate([
                'email'=>'required|unique:users,email',
            ]);
        }
        if($request->username!==$id->users->username){
            $request->validate([
                'username'=>'required|unique:users,username',
            ]);
        }
// dd('test');

        if($request->password!=null OR $request->password!=''){

        $request->validate([
            'password' => 'min:3|required_with:password2|same:password2',
            'password2' => 'min:3',
        ],
        [
            'nama.required'=>'nama harus diisi',
        ]);
            User::where('id',$id->users_id)
            ->update([
                'name'     =>   $request->nama,
                'email'     =>   $request->email,
                'username'     =>   $request->username,
                'password' => Hash::make($request->password),
               'updated_at'=>date("Y-m-d H:i:s")
            ]);
        }else{
            User::where('id',$id->users_id)
            ->update([
                'name'     =>   $request->nama,
                'username'     =>   $request->username,
                'email'     =>   $request->email,
               'updated_at'=>date("Y-m-d H:i:s")
            ]);

        }

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


        member::where('id',$id->id)
        ->update([
            'nama'     =>   $request->nama,
            'jk'     =>   $request->jk,
            'telp'     =>   $request->telp,
            'tgllahir'     =>   $request->tgllahir,
            'alamat'     =>   $request->alamat,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);
        $data_id=$id->id;

        $files = $request->file('files');
        if($files!=null){


            // dd('storage'.'/'.$id->sekolah_logo);
            $namafilebaru=$data_id;
            $tujuan_upload = 'storage/member';
                    // upload file
            $files->move($tujuan_upload,"member/".$namafilebaru.".jpg");

            $photo="member/".$namafilebaru.".jpg";


            member::where('id',$data_id)
            ->update([
                'photo'     =>   $photo,
            'updated_at'=>date("Y-m-d H:i:s")
            ]);
        }

    return redirect()->route('member')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(member $id){

        member::destroy($id->id);
        return redirect()->route('member')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }

    public function multidel(Request $request)
    {

        $ids=$request->ids;
        member::whereIn('id',$ids)->delete();

        // load ulang
        #WAJIB
        $pages='member';
        $datas=member
        ::paginate(Fungsi::paginationjml());
        // dd($datas);

        return view('pages.admin.member.index',compact('datas','request','pages'));

    }
    public function periksachat(Request $request,member $member)
    {
        $member_id=$member->id;
        #WAJIB
        $pages='member';
        $datas=chat::with('member')->with('chatdetail')->with('users')->where('member_id',$member_id)
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.member.periksachat',compact('datas','request','pages','member'));
    }
    public function periksachatstore(Request $request,member $member)
    {
        $member_id=$member->id;
        $request->validate([
            'pesan'=>'required',

        ],
        [
            'pesan.required'=>'pesan harus diisi',
        ]);
        $cek=chat::where('member_id',$member_id)
        ->count();
            if($cek>0){
                $ambildata=chat::where('member_id',$member_id)
                ->first();
                $chat_id=$ambildata->id;
                chat::where('member_id',$member_id)
                ->update([
                   'updated_at'=>date("Y-m-d H:i:s")
                ]);


            }else{
                $chat_id=DB::table('chat')->insertGetId(
                    array(
                           'member_id'     =>   $member_id,
                           'users_id'     =>   '1', //chat dengan admin
                           'status'     =>   'aktif',
                           'created_at'=>date("Y-m-d H:i:s"),
                           'updated_at'=>date("Y-m-d H:i:s")
                    ));

            }

            DB::table('chatdetail')->insertGetId(
                array(
                       'chat_id'     =>   $chat_id,
                       'users_id'     =>   '1',
                       'pesan'     =>   $request->pesan,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));






    return redirect()->route('member.periksachat',$member->id)->with('status','Pesan berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function periksachatdestroy(chatdetail $id,$member){
        chatdetail::destroy($id->id);

        return redirect()->route('member.periksachat',$member)->with('status','Pesan berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');


    }
}

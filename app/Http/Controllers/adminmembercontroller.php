<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
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
                    'password' => 'min:8|required_with:password2|same:password2',
                    'password2' => 'min:8',

                    ],
                    [
                        'username.unique'=>'username sudah digunakan',
                    ]);

            }

            $request->validate([
                'nama'=>'required',
                'username'=>'required',
                'password' => 'min:8|required_with:password2|same:password2',
                'password2' => 'min:8',

            ],
            [
                'nama.nama'=>'Nama harus diisi',
            ]);

            $cek=DB::table('member')
            ->where('nama',$request->nama)
            ->count();
                if($cek>0){
                        $request->validate([
                        'nama'=>'required|unique:member,nama',
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



            DB::table('member')->insert(
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
            'password' => 'min:8|required_with:password2|same:password2',
            'password2' => 'min:8',
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
}

<?php

namespace App\Http\Controllers;

use App\Models\dokter;
use App\Models\jadwaltreatment;
use App\Models\kategori;
use App\Models\member;
use App\Models\penjadwalan;
use App\Models\produk;
use App\Models\testimoni;
use App\Models\treatment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class adminseedercontroller extends Controller
{

    public function member(Request $request){
        // dd('seeder');
        $jmlseeder=15;
        // 1. insert dokter
        $faker = Faker::create('id_ID');

        for($i=0;$i<$jmlseeder;$i++){

            $nama=$faker->unique()->name;
            $nomerinduk=$faker->unique()->ean8;
            DB::table('member')->insert([
                'nama' =>  $nama,
                'jk' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'telp' => $faker->phoneNumber(),
                'tgllahir' => $faker->numberBetween(1990,2020).'-0'.$faker->numberBetween(1,9).'-'.$faker->numberBetween(10,29),
                'alamat' => $faker->unique()->address,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

     }

        return redirect()->back()->with('status','Seeder berhasil dimuat!')->with('tipe','success')->with('icon','fas fa-edit');

     }

     public function jadwaltreatment(){
         kategori::where('prefix','jam')->delete();

           //ambil data hari kemudian ulangi per jam dengan kode id hari tersebut
           $ambildatahari=kategori::where('prefix','hari')->get();

           foreach($ambildatahari as $data){
                $arrJam=['08:00:00','10:00:00','12:00:00','14:00:00','16:00:00'];
                foreach($arrJam as $jam){
                DB::table('kategori')->insert([
                'nama' => $jam,
                'prefix' => 'jam',
                'kode' => $data->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                ]);
                }

           }
        return redirect()->back()->with('status','Seeder berhasil dimuat!')->with('tipe','success')->with('icon','fas fa-edit');
     }

    public function treatment(Request $request){
        // dd('seeder');
        $jmlseeder=15;
        // 1. insert produk
        $faker = Faker::create('id_ID');

        for($i=0;$i<$jmlseeder;$i++){

            $nama=$faker->unique()->city;
            DB::table('treatment')->insert([
                'nama' =>  $nama,
                'harga' => $faker->numberBetween(10,200).'0000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
     }

     return redirect()->back()->with('status','Seeder berhasil dimuat!')->with('tipe','success')->with('icon','fas fa-edit');

     }

    public function produk(Request $request){
        // dd('seeder');
        $jmlseeder=15;
        // 1. insert produk
        $faker = Faker::create('id_ID');

        for($i=0;$i<$jmlseeder;$i++){

            $nama=$faker->unique()->country;
            DB::table('produk')->insert([
                'nama' =>  $nama,
                'stok' =>  '20',
                'harga' => $faker->numberBetween(10,200).'0000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

     }

        return redirect()->route('seeder.treatment')->with('status','Seeder berhasil dimuat!')->with('tipe','success')->with('icon','fas fa-edit');

    }
    public function dokter(Request $request){
        // dd('seeder');
        $jmlseeder=15;
        // 1. insert dokter
        $faker = Faker::create('id_ID');

        for($i=0;$i<$jmlseeder;$i++){

            $nama=$faker->unique()->name;
            $nomerinduk=$faker->unique()->ean8;
            DB::table('dokter')->insert([
                'nama' =>  $nama,
                'jk' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'spesialisasi' => $faker->randomElement(['Estetika', 'Umum']),
                'telp' => $faker->phoneNumber(),
                'tgllahir' => $faker->numberBetween(1990,2020).'-0'.$faker->numberBetween(1,9).'-'.$faker->numberBetween(10,29),
                'alamat' => $faker->unique()->address,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

     }

        return redirect()->route('seeder.produk')->with('status','Seeder berhasil dimuat!')->with('tipe','success')->with('icon','fas fa-edit');

    }
    public function hard(Request $request){
        produk::truncate();
        dokter::truncate();
        treatment::truncate();
        jadwaltreatment::truncate();
        penjadwalan::truncate();
        member::truncate();
        testimoni::truncate();
        // DB::table('users')->where('tipeuser','siswa')->delete();
        // DB::table('users')->where('tipeuser','guru')->delete();
        return redirect()->back()->with('status','Hard Reset berhasil dimuat!')->with('tipe','success')->with('icon','fas fa-edit');

    }

}

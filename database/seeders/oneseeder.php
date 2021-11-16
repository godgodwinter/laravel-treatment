<?php

namespace Database\Seeders;

use App\Models\kategori;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class oneseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //ADMIN SEEDER
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'tipeuser' => 'admin',
            'nomerinduk' => '1',
            'username' => 'admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);


          //settings SEEDER
        DB::table('settings')->insert([
            'app_nama' => 'Ramdani Skincare',
            'app_namapendek' => 'KRS',
            'paginationjml' => '10',
            'lembaga_nama' => 'Klinik Kecantikan Ramdani Skincare',
            'lembaga_jalan' => 'Jl. Raya Jatikerto No. 78, Kec. Kromengan, Kab. Malang',
            'lembaga_telp' => '0341-123456',
            'lembaga_kota' => 'Malang',
            'lembaga_logo' => 'assets/upload/logo.png',
            'sekolahttd' => 'Nama Kepala Sekolah M.Pd',
            'reminderjam' => '06:00:00',
            'reminderidmesin' => '772',
            'reminderpin' => '105649',
            'reminderotomatis' => 'Tidak Aktif',
            'reminderhari' => '3',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);



           $arrHari=['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
           foreach($arrHari as $hari){
            DB::table('kategori')->insert([
              'nama' => $hari,
              'prefix' => 'hari',
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now()
           ]);
           }

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



        $arrRuangan=['R1','R2','R3','R4'];
        foreach($arrRuangan as $ruangan){
         DB::table('kategori')->insert([
           'nama' => $ruangan,
           'prefix' => 'ruangan',
           'created_at' => Carbon::now(),
           'updated_at' => Carbon::now()
        ]);
        }
    }
}

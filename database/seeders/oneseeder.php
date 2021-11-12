<?php

namespace Database\Seeders;

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
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

           //ruangan
        DB::table('kategori')->insert([
            'nama' => 'Ruangan 1',
            'prefix' => 'ruangan',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('kategori')->insert([
             'nama' => 'Ruangan 2',
             'prefix' => 'ruangan',
             'created_at' => Carbon::now(),
             'updated_at' => Carbon::now()
          ]);

          DB::table('kategori')->insert([
              'nama' => 'Ruangan 3',
              'prefix' => 'ruangan',
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now()
           ]);



    }
}

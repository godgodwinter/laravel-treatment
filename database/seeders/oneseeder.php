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
            'app_nama' => 'Nama App',
            'app_namapendek' => 'St',
            'paginationjml' => '10',
            'lembaga_nama' => 'LEMBAGA PSIKOLOGI PELITA WACANA',
            'lembaga_jalan' => 'Jl.Simpang Wilis 2 Kav. B',
            'lembaga_telp' => '0341-581777',
            'lembaga_kota' => 'Malang',
            'lembaga_logo' => 'assets/upload/logo.png',
            'tapelaktif' => '2021/2022',
            'nominaltagihandefault' => '1000000',
            'passdefaultsiswa' => 'siswa123',
            'passdefaultpegawai' => '12345678',
            'passdefaultortu' => 'ortu123',
            'sekolahlogo' => '',
            'sekolahttd' => 'Nama Kepala Sekolah M.Pd',
            'sekolahttd2' => 'Nama Kepala Sekolah M.Pd', //masih konsep
            'minimalpembayaranujian' => 70, //untuk melihat pass dan user moodle
            'semesteraktif' => 1, //semesteraktif
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

    }
}

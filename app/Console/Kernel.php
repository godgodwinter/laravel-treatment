<?php

namespace App\Console;

use App\Helpers\Fungsi;
use App\Http\Controllers\smscontroller;
use App\Models\penjadwalan;
use App\Models\perawatan;
use App\Models\settings;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        if ((Fungsi::reminderotomatis()) == 'Aktif') {
            // $schedule->command('inspire')->hourly();
            $schedule->call(function () {
                // DB::table('recent_users')->delete();

                $pesan = 'Pesan';

                function sendsms($to, $pesan)
                {
                    //init SMS gateway, look at android SMS gateway
                    // $idmesin = getenv("SMSGATE_IDMESIN");
                    // $pin = getenv("SMSGATE_PIN");

                    $idmesin = Fungsi::reminderidmesin();
                    $pin = Fungsi::reminderpin();
                    // create curl resource
                    $ch = curl_init();
                    // dd("https://sms.indositus.com/sendsms.php?idmesin=$idmesin&pin=$pin&to=$to&text=$msg");
                    // set url
                    // $pesan="Yth Sdr $nama Besok Tgl $jadwal ada jadwal perawatan di Klinik Perawatan Ramdhani Skincare. Terimakasih.";
                    // dd($pesan);
                    $doKirimPesan = "https://sms.indositus.com/sendsms.php?idmesin=$idmesin&pin=$pin&to=$to&text=" . urlencode($pesan);
                    // dd($doKirimPesan);
                    curl_setopt($ch, CURLOPT_URL, $doKirimPesan);

                    //return the transfer as a string
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                    // $output contains the output string
                    $output = curl_exec($ch);

                    // close curl resource to free up system resources
                    curl_close($ch);
                    // dd($output,$doKirimPesan);
                    return ($output);
                }
                $nomer = 0;
                // $tgl=Carbon::now()->subDays(2);
                $tgl = Carbon::tomorrow();
                // dd($tgl);
                $ambildatayangdiingatkan = perawatan::with('member')->with('treatment')->where('status', 'Lunas')
                    ->get();
                $tglskrg = strtotime(date('Y-m-d'));
                // dd($ambildatayangdiingatkan->count());
                foreach ($ambildatayangdiingatkan as $data) {
                    $tglnow = date('Y-m-d');
                    $jadwalreminder = date('Y-m-d', strtotime($data->tglreminder . "-1 days"));
                    if ($tglnow == $jadwalreminder) {
                        $jadwal = $data->tglreminder ? Fungsi::tanggalindo(date('Y-m-d', strtotime($data->tglreminder))) : Fungsi::tanggalindo(date('Y-m-d', strtotime($tglnow)));
                        $telp = str_replace(' ', '', $data->member->telp);
                        $nama = $data->member->nama;
                        $nama = mb_strimwidth($data->member->nama, 0, 10, "");;
                        $pesan = "Yth Sdra / Sdri $nama Besok Tgl $jadwal ada jadwal perawatan di Klinik Perawatan Ramdhani Skincare. Terimakasih.";
                        $sending = sendsms($telp, $pesan);
                        $nomer++;
                    }
                }
            })
                ->timezone('Asia/Jakarta')
                ->dailyAt(Fungsi::reminderjam());
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}

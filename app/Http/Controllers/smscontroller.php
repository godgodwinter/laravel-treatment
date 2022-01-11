<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\penjadwalan;
use App\Models\perawatan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \Shipu\MuthoFun\Facades\MuthoFun;;
use Twilio\Rest\Client;
use Exception;

class smscontroller extends Controller
{
    public function index(){

        function sendsms($to,$msg){
            //init SMS gateway, look at android SMS gateway
            // $idmesin = getenv("SMSGATE_IDMESIN");
            // $pin = getenv("SMSGATE_PIN");

            $idmesin = Fungsi::reminderidmesin();
            $pin = Fungsi::reminderpin();
            // create curl resource
            $ch = curl_init();

            // set url
            curl_setopt($ch, CURLOPT_URL, "https://sms.indositus.com/sendsms.php?idmesin=$idmesin&pin=$pin&to=$to&text=$msg");

            //return the transfer as a string
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            // $output contains the output string
            $output = curl_exec($ch);
            // close curl resource to free up system resources
            curl_close($ch);
            return($output);
            }
            $nomer="085736862399";
            $nama='Paijo';
            $jadwal='2022-01-01';
            $sending=sendsms($nomer,"Sdr/Sdri ".$nama.", Besok ".$jadwal." ada jadwal perawatan di Klinik  Perawatan Ramdhani Skincare. Terimakasih. ");
            dd('test');
    }
    public function remindersms(Request $request){

        $pesan='Pesan';

        function sendsms($to,$msg){
            //init SMS gateway, look at android SMS gateway
            // $idmesin = getenv("SMSGATE_IDMESIN");
            // $pin = getenv("SMSGATE_PIN");

            $idmesin = Fungsi::reminderidmesin();
            $pin = Fungsi::reminderpin();
            // create curl resource
            $ch = curl_init();

            // set url
            curl_setopt($ch, CURLOPT_URL, "https://sms.indositus.com/sendsms.php?idmesin=$idmesin&pin=$pin&to=$to&text=$msg");

            //return the transfer as a string
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            // $output contains the output string
            $output = curl_exec($ch);

            // close curl resource to free up system resources
            curl_close($ch);
            return($output);
            }
            $nomer=0;
            // $tgl=Carbon::now()->subDays(2);
            $tgl=Carbon::tomorrow();
            // dd($tgl);
                    $ambildatayangdiingatkan=perawatan::with('member')->where('status','Lunas')->get();
                    // dd($ambildatayangdiingatkan);
                    foreach($ambildatayangdiingatkan as $data){
                                    $telp=str_replace(' ', '', $data->member->telp);
                        // $pesan="Yth. Sdr/Sdri ".$data->member->nama.", Kami dari Klinik Perawatan Ramdhani Skincare memberitahu bahwa besok ".$tgl->format('d-m-Y')." ada jadwal perawatan di Klinik Kami. Terimakasih.";
                                // dd('kirim pesan',$telp,$pesan);
                            // $pesan="Pesan";
                            // $pesan="Yth Sdr/Sdri ".$data->member->nama.", Besok ".$tgl->format('d-m-Y')." ada jadwal perawatan di Klinik  Perawatan Ramdhani Skincare. Terimakasih.";
                            $nama=$data->member->nama;
                            // dd($nama);
                            // $sending=sendsms($telp,$pesan);
                            $nama=mb_strimwidth($data->member->nama, 0, 6, "");;
                            $jadwal=$tgl->format('d-m-Y');
                            // dd($nama);
                            $pesan="Yth Sdr/Sdri ".$nama.", Besok Tgl ".$jadwal." ada jadwal perawatan di Klinik  Perawatan Ramdhani Skincare. Terimakasih. ";
            $sending=sendsms($telp,$pesan);
                        // dd($sending,$nama,$jadwal);
//  $sending=sendsms($telp,$pesan);
            // $sending=sendsms("085736862399","Testing sms reminder ");
                                // $sending=kirimsms($telp,$pesan);

                                $nomer++;
                    }

                    // dd('kirim pesan',$telp,$pesan,$telp);
            // dd($besok->format('d M Y'));
            // periksa jadwal perawatan //table penjadwalan where tgl
                    // $ambildatapenjadwalan=penjadwalan::with('perawatan')->get();
                    // foreach($ambildatapenjadwalan as $data){
                    //     // Carbon::now()->subDays(30)
                    //     dd(Carbon::now()->subDays(30));
                    //     $tgl=$data->tgl;
                    //     $hasil= date('Y-m-d', strtotime('-'.Fungsi::reminderhari().' days', strtotime($tgl)));

                    //     if($hasil==date('Y-m-d')){
                    //             $telp=str_replace(' ', '', $data->perawatan->member->telp);
                    //         $pesan="Yth. Sdr/Sdri ".$data->perawatan->member->nama.", Kami dari Klinik Perawatan Ramdhani Skincare memberitahu bahwa besok ".$tgl." ada jadwal perawatan di Klinik Kami. Terimakasih.";
                    //         // dd('kirim pesan',$telp,$pesan);
                    //         $sending=kirimsms($telp,$pesan);

                    //         $nomer++;
                    //         // dd('kirim pesan',$data->perawatan->member->telp);

                    //     }

                    // }
        // dd($ambildatapenjadwalan,$nomer);

            // jika ada yang h-1 maka kirim pesan
        // dd($request);
        return redirect()->back()->with('status','Pengingat berhasil di kirim! '.$nomer.' member telah diberi pesan reminder!')->with('tipe','success');
    }

    // public function index()
    // {
    //     $receiverNumber = "+6285736862399";
    //     $message = "This is testing from Testing.com";

    //     try {

    //         $account_sid = getenv("TWILIO_SID");
    //         $auth_token = getenv("TWILIO_TOKEN");
    //         $twilio_number = getenv("TWILIO_FROM");


    //         $client = new Client($account_sid, $auth_token);
    //         $client->messages->create($receiverNumber, [
    //             'from' => $twilio_number,
    //             'body' => $message]);

    //         dd('SMS Sent Successfully.');

    //     } catch (Exception $e) {
    //         dd("Error: ". $e->getMessage());
    //     }
    // }
}

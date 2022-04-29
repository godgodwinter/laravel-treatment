<x-cetak-css></x-cetak-css>
<body>
<x-cetak-kop></x-cetak-kop>

    <div style="margin-bottom: 0;text-align:center;margin-top:16px" id="judul">
        <h2>Laporan data perawatan bulan {{Fungsi::tanggalindobln($blnthn)}}</h2>
        <p for=""></p>
    </div>

    <div id="judul2">
        <h4></h4>
    </div>

    {{-- <center><h2>@yield('title')</h2></center> --}}


    <br>
    <table width="100%" id="tableBiasa">
        <tr>
            <th>
                No
            </th>
            <th>
                Nama Member
            </th>
            <th>
                Peket Treatment
            </th>

            <th>
                Status
            </th>

            {{-- <th>
                Jadwal
            </th> --}}
        </tr>
        @forelse ($datas as $data)
        <tr>

            <td class="babeng-min-row">{{$loop->index+1}}</td>

            <td > {{$data->member->nama}}</td>
            <td > {{$data->treatment->nama}} -  {{$data->treatment->reminderweek?$data->treatment->reminderweek:2}} Minggu</td>
            <td>
                {{$data->status}}
                @if($data->status=='Lunas') -
                {{$data->tglbayar?Fungsi::tanggalindo($data->tglbayar):''}}
                @endif
            </td>

            {{-- <td >
                @php
                    $hasil='Jadwal belum diatur';
                    $cek=\App\Models\penjadwalan::where('perawatan_id',$data->id)->count();
                    if($cek>0){
                    $ambil=\App\Models\penjadwalan::where('perawatan_id',$data->id)->first();
                        // dd($ambil);
                        $hasil=Fungsi::tanggalindo($ambil->tgl).' - '.$ambil->ruangan.' - '.$ambil->jam;
                    }
                @endphp

                {{$hasil}}
            </td> --}}
        </tr>

        @empty
        <tr>


            <td colspan="5"> Data tidak ditemukan</td>
        </tr>

        @endforelse
    </table>



</body>

</html>

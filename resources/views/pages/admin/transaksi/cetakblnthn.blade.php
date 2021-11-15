<x-cetak-css></x-cetak-css>
<body>
<x-cetak-kop></x-cetak-kop>

    <div style="margin-bottom: 0;text-align:center;margin-top:16px" id="judul">
        <h2>Laporan data transaksi bulan {{Fungsi::tanggalindobln($blnthn)}}</h2>
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
                Pembeli
            </th>
            <th>
                Tanggal Pembelian
            </th>

            <th>
                Jumlah Bayar
            </th>

        </tr>
        @forelse ($datas as $data)
        <tr>

            <td class="babeng-min-row">{{$loop->index+1}}</td>

            <td > {{$data->member->nama}}</td>
            <td>
                {{Fungsi::tanggalindo($data->tgl)}}
            </td>

            <td >
                {{Fungsi::rupiah($data->totaltagihan)}}
            </td>
        </tr>

        @empty
        <tr>

            <td colspan="5"> Data tidak ditemukan</td>
        </tr>

        @endforelse
    </table>



</body>

</html>

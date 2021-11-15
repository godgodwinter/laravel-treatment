<x-cetak-css></x-cetak-css>
<body>
<x-cetak-kop></x-cetak-kop>

{{--
<div style="margin-bottom: 0;text-align:center;margin-top:16px" id="judul">
    <h2>{{$datas->uuid}}</h2>
    <p for=""></p>
</div> --}}

    {{-- <center><h2>@yield('title')</h2></center> --}}

    <table>
        <tr>
            <td> Nama</td>
            <td> :</td>
            <td> {{$datas->member->nama}}</td>
        </tr>
        <tr>
            <td> Tanggal Beli</td>
            <td> :</td>
            <td> {{Fungsi::tanggalindo($datas->tgl)}}</td>
        </tr>
        <tr>
            <td> Tanggal Bayar</td>
            <td> :</td>
            <td> {{Fungsi::rupiah($datas->totaltagihan)}}</td>
        </tr>
        <tr>
            <td> Kode Transaksi</td>
            <td> :</td>
            <td> {{$datas->uuid}}</td>
        </tr>
    </table>


    <br>
    <table width="100%" id="tableBiasa">
        <tr>
            <th>
                No
            </th>
            <th>
                Produk
            </th>
            <th>
                Qty
            </th>

            <th>
                Jumlah Bayar
            </th>

        </tr>
        @forelse ($datas->transaksidetail as $data)
        <tr>

            <td class="babeng-min-row">{{$loop->index+1}}</td>
            <td>
                {{$data->produk->nama}}
            </td>
            <td>
                {{$data->jml}}
            </td>
            <td>
                {{$data->produk!=null?Fungsi::rupiah($data->jml*$data->produk->harga):'Data tidak ditemukan'}}
            </td>

        </tr>

        @empty
        <tr>

            <td colspan="5"> Data tidak ditemukan</td>
        </tr>

        @endforelse
        <tr>
            <td colspan="3">Total Tagihan</td>
            <td>{{Fungsi::rupiah($datas->totaltagihan)}}</td>
        </tr>
    </table>


    <br>
    <br>
    <img src="data:image/png;base64,{{DNS2D::getBarcodePNG(route('transaksi.cetak.invoice',$datas->id), 'QRCODE')}}" alt="barcode" class="float-left"/>


</body>

</html>

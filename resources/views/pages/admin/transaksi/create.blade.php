@extends('layouts.default')

@section('title')
Tambah Transaksi
@endsection

@push('before-script')

@if (session('status'))
<x-sweetalertsession tipe="{{session('tipe')}}" status="{{session('status')}}"/>
@endif
@endpush


@section('content')
<section class="section">
    <div class="section-header">
        <h1>@yield('title')</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
            {{-- <div class="breadcrumb-item"><a href="#">Layout</a></div> --}}
            <div class="breadcrumb-item">@yield('title')</div>
        </div>
    </div>
<div class="row">

    <div class="section-body col-12 col-lg-7 ">
        <div class="card">
            <div class="card-body">

                <div class="d-flex bd-highlight mb-3 align-items-center">

                    <div class="p-2 bd-highlight">

                        <form action="{{ route('transaksi.produk.cari') }}" method="GET">
                            <input type="text" class="babeng babeng-select  ml-0" name="cari">
                        </div>
                        <div class="p-2 bd-highlight">
                            <span>
                                <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit"
                                    value="Cari">
                            </span>
                        </div>
                    </form>


                    </div>


@push('before-script')
    <script>
        $(document).ready(function () {
            let dataProduk = [{
                id : '1',
                nama : 'PUBG',
                jml : 5,
                harga : 50000,
            },{
                id : '2',
                nama : 'WS',
                jml :15,
                harga :20000,
            }];

            // let dataMember = {
            //     id : '1',
            //     nama : 'Paijo',
            // }
            let strdataProduk = JSON.stringify(dataProduk)
            // let strdataMember = JSON.stringify(dataMember)
            let myStorage = localStorage;
                window.localStorage.setItem('adminCart', strdataProduk);
                // window.localStorage.setItem('adminPembeli',strdataMember);


        });
    </script>
@endpush


                @if($datas->count()>0)
                    <x-jsdatatable/>
                @endif

                <x-jsmultidel link="{{route('produk.multidel')}}" />

                <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                    <thead>
                        <tr style="background-color: #F1F1F1">
                            <th class="text-center py-2 babeng-min-row"> <input type="checkbox" id="chkCheckAll"> All</th>
                            <th >Nama produk</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Stok</th>
                            <th class="text-center">Photo</th>
                            <th >Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                        <tr id="sid{{ $data->id }}">
                                <td class="text-center">
                                    <input type="checkbox" name="ids" class="checkBoxClass " value="{{ $data->id }}">
                                    {{ ((($loop->index)+1)+(($datas->currentPage()-1)*$datas->perPage())) }}</td>
                                <td>
                                    {{$data->nama}}
                                </td>
                                <td class="text-center">
                                    {{Fungsi::rupiah($data->harga)}}
                                </td>
                                <td class="text-center babeng-min-row">
                                    {{$data->stok}}
                                </td>
                                <td  class="text-center babeng-min-row">
                                    @php
                                    $gambar=$data->photo;
                                    $randomimg='https://ui-avatars.com/api/?name='.$data->nama.'&color=7F9CF5&background=EBF4FF';
                                    @endphp
                                    @if($data->photo!=null AND $data->photo!=url('storage') AND $data->photo!='')
                                    <img alt="image" src="{{$gambar}}" class="img-thumbnail" data-toggle="tooltip" title="{{$data->nama}}" width="60px" height="60px" style="object-fit:cover;">
                                    @else
                                    <img alt="image" src="{{$randomimg}}" class="img-thumbnail" data-toggle="tooltip" title="{{$data->nama}}" width="60px" height="60px" style="object-fit:cover;">

                                    @endif

                                </td>

                                <td class="text-center babeng-min-row">
                                    <button class="btn btn-info btn-sm"><i class="fas fa-cart-plus"></i></button>
                                </td>


                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

@php
$cari=$request->cari;
@endphp
<div class="d-flex justify-content-between flex-row-reverse mt-3">
    <div >
{{ $datas->onEachSide(1)
    ->links() }}
    </div>
    <div>

    </div></div>

            </div>
        </div>
    </div>




    <div class="section-body col-12 col-lg-5">
        <div class="card">
            <div class="card-body">
                <h5>Keranjang</h5>

                <table id="keranjangTable" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                    <thead>
                        <tr style="background-color: #F1F1F1">
                            <th class="text-center py-2 babeng-min-row"> No</th>
                            <th >Nama produk</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Total Harga</th>

                            <th >Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="dataKeranjang">
                        <tr >
                                <td class="text-center">
                                   1</td>
                                <td>
                                   Tes
                                </td>
                                <td class="text-center babeng-min-row">
                                   4
                                </td>
                                <td class="text-center " data-toggle="tooltip" data-placement="top" title="Harga">
                                    200000
                                </td>


                                <td class="text-center babeng-min-row">
                                    <button class="btn btn-warning btn-sm"><i class="fas fa-times"></i></button>
                                </td>


                            </tr>
                    </tbody>
                    <tfoot>

                            <tr>
                                <td colspan="3" class="text-center">Total Bayar</td>
                                <td class="text-center" id="totalBayar">200000</td>
                            </tr>

                        </tfoot>
                </table>


        @push('before-script')
        <script>
            $(document).ready(function () {

                //TAMPILKANDATAKERANJANG
                let dataKeranjang='Keranjang Masih Kosong';
                const dataStrKeranjang = localStorage.getItem('adminCart');
                const dataStrKeranjangParse = JSON.parse(dataStrKeranjang);
                // console.log(dataAdminPembeli);
                if((dataStrKeranjang!=null) && (dataStrKeranjang!='')){
                    dataKeranjang=dataStrKeranjangParse.nama;
                }
                let dataProdukHTML='';
                let ttl=0;


            dataStrKeranjangParse.forEach(function(item,index){
                // console.log(item);
                let  totalHarga=item.jml*item.harga;
                ttl+=totalHarga
                dataProdukHTML+=`<tr >
                                <td class="text-center">
                                   ${index+1}</td>
                                <td>
                                ${item.nama}
                                </td>
                                <td class="text-center babeng-min-row">
                                    ${item.jml}
                                </td>
                                <td class="text-center"  data-toggle="tooltip" data-placement="top" title="Harga : ${item.harga}">
                                    ${totalHarga}
                                </td>


                                <td class="text-center babeng-min-row">
                                    <button class="btn btn-warning btn-sm" value='tes'><i class="fas fa-times"></i></button>
                                </td>


                            </tr>`;
                $('#dataKeranjang').html(dataProdukHTML);

            });
            $('#totalBayar').html(ttl)
                //END TAMPILKANDATAKERANJANG

                //CLICKSIMPAN
                //END CLICKSIMPAN

                //FUNSI
                //ENDFUNGSI

            });
        </script>
    @endpush


            </div>
        </div>



        <div class="card">
            <div class="card-body">
                <h5 id="memberSlot">Member : Belum dipilih </h5>

                <div class="form-group col-md-12 col-12 mt-0 ml-2">
                    <label for="member_id">Pilih Member <code></code></label>

                    <select class="js-example-basic-single form-control-sm @error('member_id')
                    is-invalid
                @enderror" name="member_id"  style="width: 75%" required id="member_id">

                    <option disabled selected value=""> Pilih Member</option>

                    @foreach ($member as $t)
                        <option value="{{ $t->id }}"> {{ $t->nama }}</option>
                    @endforeach
                  </select>
                    @error('member_id')<div class="invalid-feedback"> {{$message}}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between flex-row-reverse mt-3">
                    <div>
                        <button class="btn btn-info " id="memberSimpan"> Simpan</button>
                    </div>
                </div>

            </div>
        </div>

        @push('before-script')
            <script>
                $(document).ready(function () {

                    //TAMPILKANDATAMEMBER
                    let dataMember='Belum dipilih';
                    const dataAdminPembeli = localStorage.getItem('adminPembeli');
                    const dataAdminPembeliParse = JSON.parse(dataAdminPembeli);
                    // console.log(dataAdminPembeli);
                    if((dataAdminPembeli!=null) && (dataAdminPembeli!='')){
                        dataMember=dataAdminPembeliParse.nama;
                    }

                    // console.log(`${dataAdminPembeli}  ${dataMember}`);
                    $("#memberSlot").html(`Member : ${dataMember}`);
                    //END TAMPILKANDATAMEMBER

                    //CLICKSIMPAN
                    let BTNmemberSimpan = $('#memberSimpan');
                    let selectMember = $('#member_id');
                    BTNmemberSimpan.click(function () {
                        if(selectMember.val()!=null){
                            let dataMember=FungsiSelect(selectMember);
                             let strdataMember = JSON.stringify(dataMember)
                                window.localStorage.setItem('adminPembeli',strdataMember)
                                location.reload();
                        }else{
                            alert('Member Belum dipilih')
                        }

                    });
                    //END CLICKSIMPAN

                    //FUNSI
                    function FungsiSelect(sel) {
                        let selectMemberSelected = $("#member_id option:selected").html();
                            let id = sel.val();
                            let nama=selectMemberSelected;
                            console.log(`${sel.val()} nama : ${nama}`);
                                let dataMember={
                                    id: id,
                                    nama : nama
                                }
                            return dataMember
                        }
                    //ENDFUNGSI

                });
            </script>
        @endpush


        <div class="card">
            <div class="card-body">
                <h5>Checkout</h5>

                <div class="d-flex justify-content-between flex-row-reverse mt-3">
                    <div>
                        <button class="btn btn-info "> Selesaikan Transaksi</button>
                    </div>
                </div>

            </div>
        </div>


    </div>
    {{-- row --}}
</div>


</section>
@endsection


@section('containermodal')

@endsection

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



            // //CONTOH DATA PRODUK
            //     let dataProduk = [{
            //         id : '1',
            //         nama : 'Pelembab',
            //         jml : 1,
            //         harga : 5000,
            //     },{
            //         id : '2',
            //         nama : 'Cream',
            //         jml :3,
            //         harga :2000,
            //     }];
            // //ENDCONTOHDATAPRODUK
            // let dataBaru={
            //         id : '3',
            //         nama : 'Pemutih',
            //         jml : 2,
            //         harga : 5000,
            //     };
            //     dataProduk=dataProduk.concat(dataBaru);
                // console.log(dataProduk);

            // let dataMember = {
            //     id : '1',
            //     nama : 'Paijo',
            // }
            // let strdataProduk = JSON.stringify(dataProduk)
            // // let strdataMember = JSON.stringify(dataMember)
            // let myStorage = localStorage;
            //     window.localStorage.setItem('adminCart', strdataProduk);
            //     // window.localStorage.setItem('adminPembeli',strdataMember);


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
                                    <button class="btn btn-info btn-sm open-AddBookDialog" data-toggle="modal" data-id="{{$data->id}}" data-nama="{{$data->nama}}" data-stok="{{$data->stok}}" data-harga="{{$data->harga}}" title="Add this item"  href="#modalAddtoCart"><i class="fas fa-cart-plus"></i></button>
                                </td>

                                @push('before-script')
                                    <script>
                                        $(document).on("click", ".open-AddBookDialog", function () {
                                        var myId = $(this).data('id');
                                        var myNama = $(this).data('nama');
                                        var myStok = $(this).data('stok');
                                        var myHarga = $(this).data('harga');
                                        $(".modal-body #idProduk").val( myId );
                                        $(".modal-body #namaProduk").val( myNama );
                                        $(".modal-body #stokProduk").val( myStok );
                                        $(".modal-body #hargaProduk").val( myHarga );
                                        $('#jmlProduk').prop('max',myStok);
                                        // As pointed out in comments,
                                        // it is unnecessary to have to manually call the modal.
                                        // $('#addBookDialog').modal('show');
                                    });
                                    </script>
                                @endpush


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
                @error('member_id')
                        <code>Produk tidak boleh kosong</code>
                @enderror

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
                        {{-- <tr >
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
                                    <button class="btn btn-warning btn-sm BtnHapusKeranjangId"  ><i class="fas fa-times"></i></button>
                                </td>


                            </tr> --}}
                            @push('before-script')
                            <script>
                                $(document).ready(function () {
                                        $(document).on("click", ".BtnHapusKeranjangId", function () {
                                        var myId = $(this).data('id');
                                        let dataKeranjang=[];
                                        //ambil data localstorage
                                        if (localStorage.getItem('adminCart')) {
                                            try{
                                                dataKeranjang = JSON.parse(localStorage.getItem('adminCart'));
                                                }catch(e){
                                                    localStorage.removeItem('adminCart');
                                                }
                                        }
                                        console.log(myId);

                                        dataKeranjang.splice(myId,1);
                                        const parsed = JSON.stringify(dataKeranjang);
                                        localStorage.setItem('adminCart', parsed);
                                        location.reload();
                                        // parsing
                                        //splice where index
                                        //ubaH ke json
                                        //set local stroaeg baru
                                    });
                                });
                            </script>
                            @endpush
                    </tbody>
                    <tfoot>

                            <tr>
                                <td colspan="3" class="text-center">Total Bayar</td>
                                <td class="text-center" id="totalBayar">0</td>
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
                                    <button class="btn btn-warning btn-sm BtnHapusKeranjangId" data-id="${index}"><i class="fas fa-times"></i></button>
                                </td>


                            </tr>`;
                $('#dataKeranjang').html(dataProdukHTML);

            });
            $('#totalBayar').html(ttl)
                //END TAMPILKANDATAKERANJANG

                window.localStorage.setItem('totalBayar', ttl);
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
                @error('member_id')
                        <code>Member tidak boleh kosong!</code>
                @enderror

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
                <h5>Akhiri Transaksi</h5>

                <div class="d-flex justify-content-between flex-row-reverse mt-3">
                    <div>
                        <button class="btn btn-light " id="clear"> Reset</button>
                        <form action="{{route('transaksi.checkout')}}" method="POST" class="d-inline" >
                            @csrf
                                <input type="hidden" name="member_id" value="" id="formmember_id">
                                <input type="hidden" name="produk" value="" id="formproduk">
                                <input type="hidden" name="totalbayar" value="" id="formtotalbayar">
                        <button class="btn btn-info ml-2" id="checkout"> Selesaikan Transaksi</button>
                    </form>
                    </div>
                </div>
                @push('before-script')
                <script>
                    $(document).ready(function () {
                        $('#clear').click(function () {

                            window.localStorage.clear();
                            location.reload();

                        });

                        $('#checkout').click(function () {
                            // alert('Cekot')
                            let dataPembeli=null;
                            let dataKeranjang=null;
                            let StrdataKeranjang=null;
                            let totalBayar=null;
                            if (localStorage.getItem('adminCart')) {
                                try{
                                    dataKeranjang = JSON.parse(localStorage.getItem('adminCart'));
                                    StrdataKeranjang = localStorage.getItem('adminCart');
                                    }catch(e){
                                        localStorage.removeItem('adminCart');
                                    }
                            }
                            if (localStorage.getItem('adminPembeli')) {
                                try{
                                    dataPembeli = JSON.parse(localStorage.getItem('adminPembeli'));
                                    }catch(e){
                                        localStorage.removeItem('adminPembeli');
                                    }
                            }
                            if (localStorage.getItem('totalBayar')) {
                                try{
                                    totalBayar = JSON.parse(localStorage.getItem('totalBayar'));
                                    }catch(e){
                                        localStorage.removeItem('totalBayar');
                                    }
                            }


                            $('#formmember_id').val(dataPembeli.id);
                            $('#formproduk').val(StrdataKeranjang);
                            $('#formtotalbayar').val(totalBayar);

                            if(dataPembeli==null){
                                return alert('Pilih Member dahulu!')

                            }
                            if(dataKeranjang==null){
                                return alert('Keranjang tidak boleh Kosong!')
                            }
                            if(totalBayar==null){
                                return alert('Keranjang tidak boleh Kosong!')
                            }
                            console.log(totalBayar);

                            window.localStorage.clear();
                            //fungsi

                            // end fungsi
                        });
                    });
                </script>
                @endpush

            </div>
        </div>


    </div>
    {{-- row --}}
</div>


</section>
@endsection


@section('containermodal')
<!-- Import Excel -->
<div class="modal fade" id="modalAddtoCart" tabindex="-1" role="dialog" aria-labelledby="modalJudul" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalJudul">modalAddtoCart</h5>
          </div>
          <div class="modal-body">
            <div class="row">


                        <input type="hidden" class="form-control " required name="idProduk" id="idProduk">
                        {{-- <input  type="hidden" class="form-control " required name="stokProduk" id="stokProduk"> --}}

                <div class="form-group col-md-10 col-10 mt-0 ml-5">
                    <label>Nama Produk</label>
                    <div class="input-group">
                        <input type="text" class="form-control " required name="namaProduk" id="namaProduk" readonly>
                    </div>
                </div>
                <div class="form-group col-md-10 col-10 mt-0 ml-5">
                    <label>Harga Produk</label>
                    <div class="input-group">
                        <input type="text" class="form-control " required name="hargaProduk" id="hargaProduk" readonly>
                    </div>
                </div>
                <div class="form-group col-md-10 col-10 mt-0 ml-5">
                    <label>Stok Produk</label>
                    <div class="input-group">
                        <input type="number" class="form-control " required name="stokProduk" id="stokProduk" min="1" readonly>
                    </div>
                </div>
                <div class="form-group col-md-10 col-10 mt-0 ml-5">
                    <label>Jumlah Produk</label>
                    <div class="input-group">
                        <input type="number" class="form-control " required name="jmlProduk" id="jmlProduk" min="1" value="1">
                    </div>
                </div>


            </div>



          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button class="btn btn-primary" id="BtnSimpanKeKeranjang">Simpan</button>
          </div>

        </div>
    </div>
  </div>
  @push('before-script')
    <script>
        $(document).ready(function () {
$('#BtnSimpanKeKeranjang').click(function () {
    let dataKeranjang={};
    let stokProduk=parseInt($('#stokProduk').val());
    let jmlProduk=parseInt($('#jmlProduk').val());

    if(jmlProduk>stokProduk){
        alert('Stok tidak tersedia');
    }else{
        dataKeranjang={
            id : $('#idProduk').val(),
            nama : $('#namaProduk').val(),
            harga : $('#hargaProduk').val(),
            jml : $('#jmlProduk').val(),
        }

            let strdataKeranjang= JSON.stringify(dataKeranjang)
        let parsedjsonAdminCart=[];
        // ambildata local storage
        let jsonAdminCart=localStorage.getItem("adminCart");

        if(jsonAdminCart!=null){
        // parse data menjadi objek
         parsedjsonAdminCart=JSON.parse(jsonAdminCart);
            //masukkan data baru kedalam objek locakstorage yang telah di parse
            parsedjsonAdminCart.push(dataKeranjang);
        }else{
            parsedjsonAdminCart=[dataKeranjang];

        }
        // console.log(parsedjsonAdminCart);

        //ubah menjadi json dahulu
            let strdataProduk = JSON.stringify(parsedjsonAdminCart)
        // kirim ke localstorage
                window.localStorage.setItem('adminCart', strdataProduk);
                location.reload();
    }
});
        });
    </script>
  @endpush

@endsection

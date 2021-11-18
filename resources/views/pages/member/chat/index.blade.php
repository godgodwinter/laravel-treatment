@extends('layouts.default')

@section('title')
Kontak Admin
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


    <div class="section-body  col-md-7 col-12">
        <div class="card">
            <div class="card-body ">





                @if($datas->count()>0)
                    <x-jsdatatable/>
                @endif


                <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                    <thead>
                        <tr style="background-color: #F1F1F1">
                            <th  class="text-center" colspan="3">Pesan</th>
                        </tr>
                    </thead>
                    <tbody>
                            {{-- <tr>
                                    <td class="text-center babeng-min-row">
                                        <img src="{{asset('assets/img/avatar/avatar-3.png')}}" alt="namaPelanggan" width="50px">
                                        <br>
                                        <b>Nama member</b>
                                    </td>
                                    <td class="text-left">
                                     <button class="btn text-success"> Pesan MEmber</button>
                                     <p style="font-size: 8pt" ><i>{{Fungsi::tanggalindo(date('Y-m-d'))}} {{date('H:i:s')}}</i></p>
                                    </td>
                                    <td class="text-center babeng-min-row">
                                    </td>
                                </tr>

                            <tr>
                                <td class="text-center babeng-min-row">
                                    <img src="{{asset('assets/img/avatar/avatar-3.png')}}" alt="namaPelanggan" width="50px">
                                    <br>
                                    <b>Nama member</b>
                                </td>
                                <td class="text-left">
                                 <button class="btn text-success"> Pesan MEmber</button>
                                 <p style="font-size: 8pt" ><i>{{Fungsi::tanggalindo(date('Y-m-d'))}} {{date('H:i:s')}}</i></p>
                                </td>
                                <td class="text-center babeng-min-row">
                                </td>
                            </tr>

                        <tr>
                            <td class="text-center babeng-min-row">
                            </td>
                            <td class="text-right">
                                <button class="btn text-info"> Pesan Admin</button>
                                <p style="font-size: 8pt" ><i>{{Fungsi::tanggalindo(date('Y-m-d'))}} {{date('H:i:s')}}</i></p>
                            </td>
                            <td class="text-center babeng-min-row">
                                <img src="{{asset('assets/img/avatar/avatar-3.png')}}" alt="namaPelanggan" width="50px">
                                <br>
                                <b>Nama Admin</b>
                            </td>
                        </tr> --}}
                        @forelse ($datas as $data)
                                @forelse ($data->chatdetail as $pesan)
                                {{-- {{dd($data->chatdetail)}} --}}
                                @php
                                    $ambildata=App\Models\User::where('id',$pesan->users_id)->first();
                                    $tipeuser=$ambildata->tipeuser;
                                    // dd($pesan,$tipeuser);
                                @endphp
                                    @if($tipeuser=='member')
                                    <tr>
                                        <td class="text-center babeng-min-row">
                                            <img src="{{asset('assets/img/avatar/avatar-3.png')}}" alt="namaPelanggan" width="50px">
                                            <br>
                                            <b>{{$data->member->nama}}</b>
                                        </td>
                                        <td class="text-left">
                                        <button class="btn btn-success px-5"> {{$pesan->pesan}}</button>
                                        <p style="font-size: 8pt" ><i>{{$pesan->created_at}}</i></p>
                                        <form action="{{route('member.chatdetail.destroy',[$pesan->id,$data->member_id])}}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button  style="font-size: 8pt" class=" btn btn-sm btn-danger"
                                                onclick="return  confirm('Anda yakin menghapus pesan ini? Y/N')"  data-toggle="tooltip" data-placement="top" title="Hapus pesan!"><span
                                                    class="pcoded-micon"> <i class="fas fa-trash"></i></span></button>
                                        </form>
                                        </td>
                                        <td class="text-center babeng-min-row">
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td class="text-center babeng-min-row">
                                        </td>
                                        <td class="text-right">
                                        <button class="btn btn-info px-5"> {{$pesan->pesan}}</button>
                                        <p style="font-size: 8pt" ><i>{{$pesan->created_at}}</i></p>
                                        </td>
                                        <td class="text-center babeng-min-row">
                                            <img src="{{asset('assets/img/avatar/avatar-3.png')}}" alt="namaPelanggan" width="50px">
                                            <br>
                                            <b>{{$pesan->users->name}}</b>
                                        </td>
                                    </tr>
                                    @endif



                                @empty

                                @endforelse
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada pesan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>


            </div>
        </div>
    </div>



    <div class="section-body col-md-5 col-12">
        <div class="card">
            <div class="card-body ">
                <h5>Tulis Pesan</h5>



                <form action="{{route('member.chat.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group col-md-12 col-12 mt-0 ">
                        <textarea class="form-control" style="min-width: 100%;height:100%;" name="pesan"
                                id="pesan" required ></textarea>
                        @error('pesan')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>





                    <div class="card-footer text-right ">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>




            </div>
        </div>
    </div>

    </div>
</section>
@endsection


@section('containermodal')

@endsection

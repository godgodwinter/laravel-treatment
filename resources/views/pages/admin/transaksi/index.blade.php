@extends('layouts.default')

@section('title')
Transaksi
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

    <div class="section-body">
        <div class="card">
            <div class="card-body">

                <div class="d-flex bd-highlight mb-3 align-items-center">

                    <div class="p-2 bd-highlight">

                        <form action="{{ route('transaksi.cari') }}" method="GET">

                            <input type="month" name="blnthn" id="blnthn"
                            class="form-control " placeholder=""
                            value="{{$blnthn?$blnthn:date('Y-m')}}" required>
                        </div>
                        <div class="p-2 bd-highlight">
                            <span>
                                <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit"
                                    value="Pilih">
                            </span>
                        </div>

                        <div class="ml-auto p-2 bd-highlight">

                            <a href="{{route('transaksi.cetak.blnthn',$blnthn?$blnthn:date('Y-m'))}}" class="btn btn-icon btn-primary  ml-0 btn-sm px-3"><i class="far fa-file-pdf"></i> Cetak</a>

                            <x-button-create link="{{route('transaksi.create')}}"></x-button-create>
                        </form>

                    </div>
                </div>




                @if($datas->count()>0)
                    <x-jsdatatable/>
                @endif

                <x-jsmultidel link="{{route('transaksi.multidel')}}" />

                <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                    <thead>
                        <tr style="background-color: #F1F1F1">
                            <th class="text-center py-2 babeng-min-row"> <input type="checkbox" id="chkCheckAll"> All</th>
                            <th >Pembeli</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Status</th>
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
                                    {{$data->member?$data->member->nama: 'Data tidak ditemukan'}}
                                </td>
                                <td class="text-center">
                                    {{Fungsi::tanggalindo($data->tgl)}}
                                </td>
                                <td class="text-center babeng-min-row">
                                    {{Fungsi::rupiah($data->totaltagihan)}}
                                </td>
                                <td  class="text-center babeng-min-row">
                                    @if($data->status=='pending')
                                        <span class="badge badge-info">
                                    @elseif($data->status=='success')
                                    <span class="badge badge-success">
                                    @else
                                        <span class="badge badge-danger">
                                    @endif

                                    {{Str::ucfirst($data->status) }}

                                    </span>

                                </td>

                                <td class="text-center babeng-min-row">
                                    <button class="btn btn-sm btn-info">Detail</button>
                                    <x-button-delete link="/admin/{{ $pages }}/{{$data->id}}" />
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
<a href="#" class="btn btn-sm  btn-danger mb-2" id="deleteAllSelectedRecord"
            onclick="return  confirm('Anda yakin menghapus data ini? Y/N')"  data-toggle="tooltip" data-placement="top" title="Hapus Terpilih">
            <i class="fas fa-trash-alt mr-2"></i> Hapus Terpilih</i>
        </a></div></div>

            </div>
        </div>
    </div>
</section>
@endsection


@section('containermodal')

@endsection

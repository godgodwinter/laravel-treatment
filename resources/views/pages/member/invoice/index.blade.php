@extends('layouts.default')

@section('title')
Jadwal Treatmentku
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


    <div class="section-body  col-md-12 col-12">
        <div class="card">
            <div class="card-body ">





                @if($datas->count()>0)
                    <x-jsdatatable/>
                @endif


                <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                    <thead>
                        <tr style="background-color: #F1F1F1">
                            <th class="text-center py-2 babeng-min-row"> No</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Cetak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                        <tr id="sid{{ $data->id }}">
                                <td class="text-center">

                                    {{ ((($loop->index)+1)+(($datas->currentPage()-1)*$datas->perPage())) }}</td>
                                <td>
                                    {{$data->tgl?Fungsi::tanggalindo($data->tgl):'Data tidak ditemukan'}}
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
                                <td class="babeng-min-row">

                                    <a href="{{route('transaksi.cetak.invoice',$data->id)}}" class="btn btn-sm btn-info">Invoice</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>


            </div>
        </div>
    </div>



    </div>
</section>
@endsection


@section('containermodal')

@endsection

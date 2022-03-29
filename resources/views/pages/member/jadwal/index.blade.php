@extends('layouts.default')

@section('title')
Jadwal Treatment
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
                            <th class="text-center">Paket Treatment </th>
                            <th  class="text-center">Status </th>
                            <th class="text-center">Jadwal perawatan</th>
                            <th class="text-center">Jadwal Perawatan Selanjutnya</th>
                            {{-- <th class="text-center">Status</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                        <tr >
                                <td class="text-center">

                                    {{ (($loop->index)+1) }}</td>
                                <td class="text-center">
                                    {{$data->treatment->nama?$data->treatment->nama:"Data tidak ditemukan"}}
                                </td>
                                <td class="text-center">
                                    {{$data->status}}
                                </td>
                                <td class="text-center">
                                    @if($data->status=='Lunas') 
                                    {{$data->tglbayar?Fungsi::tanggalindo($data->tglbayar):''}}
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{$data->tglbayar?Fungsi::tanggalindo(date('Y-m-d',strtotime($data->tglbayar . "+14 days"))):''}}
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

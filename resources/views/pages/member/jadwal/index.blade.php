@extends('layouts.default')

@section('title')
Rekam Medik
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
                            <th class="text-center">Tanggal perawatan</th>
                            {{-- <th class="text-center">Jadwal Perawatan Selanjutnya</th> --}}
                            <th class="text-center">Status Perawatan</th>
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
                                {{-- <td class="text-center">
                                    {{$data->tglbayar?Fungsi::tanggalindo(date('Y-m-d',strtotime($data->tglbayar . "+14 days"))):''}}
                                </td> --}}

<td class="text-center">
    @if($data->statustreatment=='Sudah Treatment')
                                    <button  class="btn btn-icon btn-info btn-sm ml-0 px-2"  data-toggle="tooltip" data-placement="top" title="Sudah Treatment!"><i class="fas fa-check"></i></button>
                                    @else 
                                    <button  class="btn btn-icon btn-danger btn-sm ml-0 px-2"  data-toggle="tooltip" data-placement="top" title="Belum Treatment!"><i class="fas fa-times"></i></button>
                                    @endif
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

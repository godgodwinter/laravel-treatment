@extends('layouts.default')

@section('title')
Testimoni
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
                            <th >Tanggal </th>
                            <th class="text-center">Jam</th>
                            <th class="text-center">Ruangan</th>
                            {{-- <th class="text-center">Status</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                        <tr >
                                <td class="text-center">

                                    {{ (($loop->index)+1) }}</td>
                                <td class="text-center">
                                            {{$data->tgl?Fungsi::tanggalindo($data->tgl):'Jadwal belum ditentukan'}}
                                </td>
                                <td class="text-center">
                                            {{$data->jam?$data->jam:'Jadwal belum ditentukan'}}
                                </td>
                                <td class="text-center">
                                            {{$data->ruangan?$data->ruangan:'Jadwal belum ditentukan'}}
                                </td>
                                {{-- <td class="text-center">
                                            {{$data->status?$data->status:'Jadwal belum ditentukan'}}
                                </td> --}}
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

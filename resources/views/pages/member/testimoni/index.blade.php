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


    <div class="section-body  col-md-7 col-12">
        <div class="card">
            <div class="card-body ">





                @if($datas->count()>0)
                    <x-jsdatatable/>
                @endif


                <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                    <thead>
                        <tr style="background-color: #F1F1F1">
                            <th class="text-center py-2 babeng-min-row"> No</th>
                            <th >Nama testimoni</th>
                            <th class="text-center">Pesan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                        <tr id="sid{{ $data->id }}">
                                <td class="text-center">

                                    {{ ((($loop->index)+1)+(($datas->currentPage()-1)*$datas->perPage())) }}</td>
                                <td>
                                    {{$data->member?$data->member->nama:'Data tidak ditemukan'}}
                                </td>
                                <td class="text-center">
                                    {{ $data->pesan }}
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



    <div class="section-body col-md-5 col-12">
        <div class="card">
            <div class="card-body ">
                <h5>Tulis Testimoni</h5>



                <form action="{{route('member.testimoni.store')}}" method="post" enctype="multipart/form-data">
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

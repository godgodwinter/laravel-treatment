@extends('layouts.default')

@section('title')
Perawatan
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

                        <form action="{{ route('perawatan.cari') }}" method="GET">
                            <input type="text" class="babeng babeng-select  ml-0" name="cari">
                        </div>
                        <div class="p-2 bd-highlight">
                            <span>
                                <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit"
                                    value="Cari">
                            </span>
                        </div>

                        <div class="ml-auto p-2 bd-highlight">
                            <x-button-create link="{{route('perawatan.create')}}"></x-button-create>
                        </form>

                    </div>
                </div>




                @if($datas->count()>0)
                    <x-jsdatatable/>
                @endif

                <x-jsmultidel link="{{route('perawatan.multidel')}}" />

                <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                    <thead>
                        <tr style="background-color: #F1F1F1">
                            <th class="text-center py-2 babeng-min-row"> <input type="checkbox" id="chkCheckAll"> All</th>
                            <th >Nama Member</th>
                            <th >Paket Treatment</th>
                            <th >Status</th>
                            <th >Jadwal</th>
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
                                    {{$data->member->nama?$data->member->nama:"Data tidak ditemukan"}}
                                </td>
                                <td>
                                    {{$data->treatment->nama?$data->treatment->nama:"Data tidak ditemukan"}}
                                </td>
                                <td>
                                    {{$data->status}}
                                    @if($data->status=='Lunas') -
                                    {{$data->tglbayar?Fungsi::tanggalindo($data->tglbayar):''}}
                                    @endif
                                </td>
                                <td id="jadwalAtur{{ $data->id }}" data-toggle="modal" data-target="#modaljadwalAtur{{ $data->id }}">
                                    Jadwal belum diatur
                                </td>
                                {{-- @push('after-style')
                                <script>
                                    $(function () {
                                        $('#jadwalAtur{{ $data->id }}').click(function () {
                                            console.log('test{{ $data->id }}');
                                        });
                                    });
                                </script>
                                @endpush --}}

                                <td class="text-center babeng-min-row">
                                    {{-- <x-button-reset-pass link="/admin/{{ $pages }}/{{$data->id}}/reset" /> --}}
                                    <x-button-edit link="/admin/{{ $pages }}/{{$data->id}}" />
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
@forelse ($datas as $data)
<!-- Import Excel -->
<div class="modal fade" id="modaljadwalAtur{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form method="post" action="#" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{$data->member->nama}}</h5>
          </div>
          <div class="modal-body">
              {{ csrf_field() }}
            <div class="row">
                <div class="col-12">

                    <label>Pilih file excel(.xlsx)</label>
                    <div class="form-group">
                      <input type="file" name="file" required="required">
                    </div>

                </div>
                {{-- <div class="col-12">
                    <label>Jumlah Materi</label>
                    <div class="form-group">
                      <input type="number" class="form-control" name="jml" required="required">
                    </div>

                </div> --}}
            </div>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Import</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  @endforeach
@endsection

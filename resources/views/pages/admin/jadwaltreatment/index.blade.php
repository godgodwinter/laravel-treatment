@extends('layouts.default')

@section('title')
Mastering Jadwal Treatment
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





                @if($datas->count()>0)
                    <x-jsdatatable/>
                @endif

                <x-jsmultidel link="{{route('produk.multidel')}}" />

                <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                    <thead>
                        <tr style="background-color: #F1F1F1">
                            <th class="text-center py-2 babeng-min-row">  No</th>
                            <th >Hari</th>
                            <th >Jam</th>
                            <th >Ruangan</th>
                            {{-- <th >Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                        <tr >
                                <td class="text-center">

                                    {{ ((($loop->index)+1)) }}</td>
                                <td>
                                    {{-- {{dd($data->id)}} --}}
                                    {{$data->hari}}
                                </td>
                                <td>
                                    @forelse ($data->jam as $jam)
                                    <form action="{{route('jadwaltreatment.destroyjam',$jam->id)}}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button  class="btn btn-light"
                                            onclick="return  confirm('Anda yakin menghapus data ini? Y/N')"  data-toggle="tooltip" data-placement="top" title="Hapus Data!"><span
                                                class="pcoded-micon">{{$jam->nama}}</span></button>
                                    </form>
                                        {{-- <a class="btn btn-light" href="{{route('jadwaltreatment.destroyjam',$jam->id)}}" > {{$jam->nama}}</a> --}}
                                    @empty
                                        Data tidak ditemukan
                                    @endforelse

                                    <button class="btn btn-sm btn-info"  data-toggle="modal" data-target="#modalJam{{ $data->id }}"><i class="fas fa-plus-square"></i> </button>
                                </td>

                                <td class="babeng-min-row">
                                    @forelse ($data->ruangan as $ruangan)
                                     <button class="btn btn-light"> {{$ruangan}}</button>
                                    @empty

                                    @endforelse
                                    <button class="btn btn-sm btn-info"><i class="fas fa-plus-square"></i> </button>
                                </td>
                                {{-- <td class="babeng-min-row">
                                    <button class="btn btn-sm btn-info"> Edit </button>
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
</section>
@push('after-style')
<link rel="stylesheet" href="{{asset('/')}}assets/modules/bootstrap-timepicker/bootstrap-timepicker.min.css">
@endpush
@push('before-script')
<script src="{{asset('/')}}assets/modules/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
@endpush
@endsection



@section('containermodal')
@forelse ($datas as $data)
<!-- Import Excel -->
<div class="modal fade" id="modalJam{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{$data->hari}}</h5>
          </div>
          <form action="{{route('jadwaltreatment.storejam')}}" method="post">
            @csrf
          <div class="modal-body">
            <div class="row">

                <div class="form-group col-md-5 col-12 mt-0 ml-5">
                    <label>Tambahkan Jam</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-clock"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control timepicker" required name="nama">
                        <input type="hidden" required name="kode" value="{{$data->id}}" readonly>
                      </div>
                    </div>
                </div>



          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>

        </form>
        </div>
    </div>
  </div>
  @endforeach
@endsection


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
                            <input type="month" name="blnthn" id="blnthn"
                            class="form-control " placeholder=""
                            value="{{$blnthn?$blnthn:date('Y-m')}}" required>
                        </div>
                        <div class="p-2 bd-highlight">
                            <span>
                                <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit"
                                    value="Cari">
                            </span>
                        </div>

                        <div class="ml-auto p-2 bd-highlight">
                            <a href="{{route('perawatan.cetak.blnthn',$blnthn?$blnthn:date('Y-m'))}}" class="btn btn-icon btn-primary  ml-0 btn-sm px-3"><i class="far fa-file-pdf"></i> Cetak</a>

                        </form>
                            <a href="#"  data-toggle="modal" data-target="#modalReminder" class="btn btn-icon btn-primary  ml-0 btn-sm px-3"><i class="fas fa-sms"></i> Reminder</a>
                            <x-button-create link="{{route('perawatan.create')}}"></x-button-create>



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
                            <th >Jadwal Perawatan</th>
                            <th >Jadwal Perawatan Selanjutnya</th>
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
                                </td>
                                <td>
                                    @if($data->status=='Lunas') 
                                    {{$data->tglbayar?Fungsi::tanggalindo($data->tglbayar):''}}
                                    @endif
                                </td>
                                <td>
                                    {{$data->tglbayar?Fungsi::tanggalindo(date('Y-m-d',strtotime($data->tglbayar . "+14 days"))):''}}
                                </td>
                                {{-- <td id="jadwalAtur{{ $data->id }}" data-toggle="modal" data-target="#modaljadwalAtur{{ $data->id }}">
                                    @php
                                        $hasil='Jadwal belum diatur';
                                        $warna='danger';
                                        $cek=\App\Models\penjadwalan::where('perawatan_id',$data->id)->count();
                                        if($cek>0){
                                        $ambil=\App\Models\penjadwalan::where('perawatan_id',$data->id)->first();
                                            // dd($ambil);
                                            $warna='light';
                                            $hasil=Fungsi::tanggalindo($ambil->tgl).' - '.$ambil->ruangan.' - '.$ambil->jam;
                                        }
                                    @endphp
                                    <button class="btn btn-{{$warna}}">{{$hasil}}</button>
                                    </td> --}}
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
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nama : {{$data->member->nama}} <br> Paket Treatment : {{$data->treatment->nama}} - {{Fungsi::rupiah($data->treatment->harga)}}</h5>
          </div>
          <form action="{{route('perawatan.tambahjadwal',$data->id)}}" method="post">
            @csrf
          <div class="modal-body">
            <div class="row">

                @php
                $hasil='Jadwal belum diatur';
                $tgl=date('Y-m-d');
                $cek=\App\Models\penjadwalan::where('perawatan_id',$data->id)->count();
                $ambil=null;
                if($cek>0){
                $ambil=\App\Models\penjadwalan::with('dokter')->where('perawatan_id',$data->id)->first();
                    // dd($ambil);
                    $hasil=Fungsi::tanggalindo($ambil->tgl).' - '.$ambil->ruangan.' - '.$ambil->jam;
                    $tgl=$ambil->tgl;
                }
            @endphp
                <div class="form-group col-md-5 col-12 mt-0 ml-5">
                    <label for="tgl">Pilih Tanggal Perawatan<code>*)</code></label>
                    <input type="date" name="tgl" id="tgl{{$data->id}}" class="form-control @error('tgl') is-invalid @enderror" value="{{old('tgl')?old('tgl') : $tgl}}" required>
                    @error('tgl')<div class="invalid-feedback"> {{$message}}</div>
                    @enderror
                </div>

                @push('before-script')
                <script>

                    $(function () {
                        let tgl{{$data->id}} = $('#tgl{{$data->id}}');
                        let ruangandanhari{{$data->id}} = $('#ruangandanhari{{$data->id}}');

                        tgl{{$data->id}}.change(function () {
                            // e.preventDefault();
                            console.log(tgl{{$data->id}}.val());

                            let component=`<h4>${tgl{{$data->id}}.val()}</h4`;
                            // ruangandanhari{{$data->id}}.html(component);



                        });
                    });
                </script>
                @endpush


                <div class="form-group col-md-5 col-12 mt-0 ml-5">
                    <label for="dokter_id">Pilih Dokter <code></code></label>

                    <select class="js-example-basic-single form-control-sm @error('dokter_id')
                    is-invalid
                @enderror" name="dokter_id"  style="width: 75%" required>
                @if($ambil!=null)

                @if($ambil->dokter)
                <option  selected value="{{$ambil->dokter->id}}"> {{$ambil->dokter->nama}}</option>
                @else
                <option disabled selected value=""> Pilih Dokter</option>
                @endif

                @else

                <option disabled selected value=""> Pilih Dokter</option>
                @endif
                    @foreach ($dokter as $t)
                        <option value="{{ $t->id }}"> {{ $t->nama }}</option>
                    @endforeach
                  </select>
                    @error('dokter_id')<div class="invalid-feedback"> {{$message}}</div>
                    @enderror
                </div>
                </div>

            <div class="row" id="ruangandanhari{{$data->id}}">

                <div class="form-group col-md-3 col-12 mt-0 ml-5">
                    <label class="form-label">Pilih Ruangan 2</label>
                    <div class="selectgroup w-100">




                    @foreach ($ruangan as $t)
                      <label class="selectgroup-item">
                        @if($ambil!=null)
                        <input type="radio" name="ruangan" value="{{$t->nama}}" class="selectgroup-input"  {{$ambil->ruangan==$t->nama?'checked=""':''}}>
                      @else
                      <input type="radio" name="ruangan" value="{{$t->nama}}" class="selectgroup-input"  {{$loop->index=='0'?'checked=""':''}}>
                      @endif
                      <span class="selectgroup-button">{{$t->nama}}</span>
                      </label>

                      @endforeach

                    </div>
                  </div>

                <div class="form-group col-md-6 col-12 mt-0 ml-5">
                    <label class="form-label">Pilih Jam</label>
                    <div class="selectgroup w-100">
                    @foreach ($jam as $t)
                      <label class="selectgroup-item">
                          @if($ambil!=null)
                          <input type="radio" name="jam" value="{{$t->nama}}" class="selectgroup-input"  {{$ambil->jam==$t->nama?'checked=""':''}}>
                        @else
                        <input type="radio" name="jam" value="{{$t->nama}}" class="selectgroup-input"  {{$loop->index=='0'?'checked=""':''}}>
                        @endif
                        <span class="selectgroup-button">{{$t->nama}}</span>
                      </label>
                    @endforeach


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
  @push('after-style')
  <link rel="stylesheet" href="{{asset('/')}}assets/modules/bootstrap-timepicker/bootstrap-timepicker.min.css">
  @endpush
  @push('before-script')
  <script src="{{asset('/')}}assets/modules/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
  @endpush
  @endforeach


<div class="modal fade" id="modalReminder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Reminder</h5>
          </div>
          <form action="{{route('settings.reminder')}}" method="post">
            @csrf
          <div class="modal-body">

                {{-- <div class="form-group col-md-10 col-12 mt-0">
                    <label>Jam Pengingat</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-clock"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control timepicker" value="{{Fungsi::reminderjam()!=null?Fungsi::reminderjam():'05:00:00'}}" required name="reminderjam">
                      </div>
                    </div> --}}


                <div class="form-group col-md-10 col-12 mt-0">
                    <label>ID Mesin</label>
                    <div class="input-group">
                        <input type="text" class="form-control " value="{{Fungsi::reminderidmesin()!=null?Fungsi::reminderidmesin():'123'}}" required name="reminderidmesin">
                      </div>
                    </div>


                <div class="form-group col-md-10 col-12 mt-0">
                    <label>Pin</label>
                    <div class="input-group">
                        <input type="text" class="form-control " value="{{Fungsi::reminderpin()!=null?Fungsi::reminderpin():'123'}}" required name="reminderpin">
                      </div>
                    </div>


                        {{-- <div class="input-group">
                            <input type="text" class="form-control " value="{{Fungsi::reminderotomatis()!=null?Fungsi::reminderotomatis():'Aktif'}}" required name="reminderotomatis">
                          </div> --}}
                    {{-- <div class="form-group col-md-10 col-12 mt-0">
                        <label>Pengingat otomatis</label>

                            <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                                <input type="radio" name="reminderotomatis" value="Aktif" class="selectgroup-input" {{Fungsi::reminderotomatis()=='Aktif'?'checked=""':''}}>
                                <span class="selectgroup-button">Aktif</span>
                            </label>
                              <label class="selectgroup-item">
                                <input type="radio" name="reminderotomatis" value="Tidak aktif" class="selectgroup-input" {{Fungsi::reminderotomatis()=='Aktif'?'':'checked=""'}}>
                                <span class="selectgroup-button">Tidak Aktif</span>
                              </label>

                            </div>
                        </div> --}}

                    {{-- <div class="form-group col-md-10 col-12 mt-0">
                        <label>Ingatkan sebelum (Hari)</label>
                        <div class="input-group">
                            <input type="number" class="form-control " value="{{Fungsi::reminderhari()!=null?Fungsi::reminderhari():'1'}}" required name="reminderhari" min="1" max="10">
                          </div>
                        </div> --}}



          </div>
          <div class="modal-footer">
            <a href="{{route('reminder.remindersms')}}" class="btn btn-warning">Kirim Reminder</a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>

          </div>

        </form>
        </div>
    </div>
  </div>

@endsection

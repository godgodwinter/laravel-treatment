@extends('layouts.default')

@section('title')
perawatan
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
            <div class="breadcrumb-item"><a href="{{route('perawatan')}}">@yield('title')</a></div>
            <div class="breadcrumb-item">Tambah</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h5>Tambah</h5>
            </div>
            <div class="card-body">

                <form action="{{route('perawatan.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">


                        <div class="form-group col-md-5 col-5 mt-0 ml-5">
                            <label for="member_id">Pilih Member <code></code></label>

                            <select class="js-example-basic-single form-control-sm @error('member_id')
                            is-invalid
                        @enderror" name="member_id"  style="width: 75%" required>

                            <option disabled selected value=""> Pilih Member</option>

                            @foreach ($member as $t)
                                <option value="{{ $t->id }}"> {{ $t->nama }}</option>
                            @endforeach
                          </select>
                            @error('member_id')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
                        </div>



                        <div class="form-group col-md-5 col-5 mt-0 ml-5">
                            <label for="treatment_id">Pilih Treatment
                                {{-- <code >(reminder per minggu)</code> --}}
                            </label>

                            <select class="js-example-basic-single form-control-sm @error('treatment_id')
                            is-invalid
                        @enderror" name="treatment_id"  style="width: 75%" required>

                            <option disabled selected value=""> Pilih Treatment </option>

                            @foreach ($treatment as $t)
                                <option value="{{ $t->id }}"> {{ $t->nama }} </option>
                                {{-- <option value="{{ $t->id }}"> {{ $t->nama }} - {{ $t->reminderweek?$t->reminderweek:2 }} minggu</option> --}}
                            @endforeach
                          </select>
                            @error('treatment_id')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
                        </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="status">Pilih Status Pembayaran <code></code></label>

                        <select class="form-control  @error('status') is-invalid @enderror" name="status" required>
                            <option>Lunas</option>
                            <option>Belum dibayar</option>
                        </select>
                        @error('status')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>


                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="tglbayar">Tanggal Perawatan<code> </code></label>
                        <input type="date" name="tglbayar" id="tglbayar" class="form-control @error('tglbayar') is-invalid @enderror" value="{{old('tglbayar')?old('tglbayar') : date('Y-m-d')}}" required>
                        @error('tglbayar')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                @php
                $tglnow = (date('Y-m-d'));
                // $tglskrg = strtotime(date('Y-m-d'));
                //      $jmlhari = 14;
                //     $jmlhari = ($t->reminderweek ? $t->reminderweek : 2) * 7;
                //     $jmldetik =(86400 * $jmlhari);
                //     $tglreminder = $tglskrg + $jmldetik;
                            // $jadwal = date('Y-m-d', strtotime($tglreminder));
                            $jadwal = date('Y-m-d', strtotime($tglnow . "+14 days"));
                            // dd($tglskrg,$tglreminder,$jadwal);
                            // dd($jadwal);
                            // $jadwal = date('Y-m-d', strtotime($data->tglbayar . "+14 days"));
                @endphp
                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="tglreminder">Tanggal Perawatan Selanjutnya<code> </code></label>
                        <input type="date" name="tglreminder" id="tglreminder" class="form-control @error('tglreminder') is-invalid @enderror" value="{{old('tglreminder')?old('tglreminder') :$jadwal}}" required>
                        @error('tglreminder')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>


                    </div>

                    <div class="card-footer text-right mr-5">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</section>
@endsection

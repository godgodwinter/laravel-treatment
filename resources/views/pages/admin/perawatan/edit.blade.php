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
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h5>Edit</h5>
            </div>
            <div class="card-body">

                <form action="{{route('perawatan.update',$id->id)}}" method="post">
                    @method('put')
                    @csrf

                    <div class="row">

                        <div class="form-group col-md-5 col-5 mt-0 ml-5">
                            <label for="member_id">Pilih Member <code></code></label>

                            <select class="js-example-basic-single form-control-sm @error('member_id')
                            is-invalid
                        @enderror" name="member_id"  style="width: 75%" required>

                        @if(old('member_id'))
                        <option>{{old('member_id')}}</option>
                    @else
                        @if($id->member_id)
                        <option value="{{$id->member->id}}">{{$id->member->nama}}</option>
                        @endif
                    @endif

                            @foreach ($member as $t)
                                <option value="{{ $t->id }}"> {{ $t->nama }}</option>
                            @endforeach
                          </select>
                            @error('member_id')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
                        </div>



                        <div class="form-group col-md-5 col-5 mt-0 ml-5">
                            <label for="treatment_id">Pilih Treatment <code></code></label>

                            <select class="js-example-basic-single form-control-sm @error('treatment_id')
                            is-invalid
                        @enderror" name="treatment_id"  style="width: 75%" required>


                        @if(old('treatment_id'))
                        <option>{{old('treatment_id')}}</option>
                    @else
                        @if($id->treatment_id)
                        <option value="{{$id->treatment->id}}">{{$id->treatment->nama}}</option>
                        @endif
                    @endif


                            @foreach ($treatment as $t)
                                <option value="{{ $t->id }}"> {{ $t->nama }}</option>
                            @endforeach
                          </select>
                            @error('treatment_id')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
                        </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="status">Pilih Status Pembayaran <code></code></label>

                        <select class="form-control  @error('status') is-invalid @enderror" name="status" required>

                        @if(old('status'))
                        <option>{{old('status')}}</option>
                    @else

                        <option >{{$id->status}}</option>
                    @endif
                            <option>Lunas</option>
                            <option>Belum dibayar</option>
                        </select>
                        @error('status')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>


                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="tglbayar">Tanggal Perawatan<code> </code></label>
                        <input type="date" name="tglbayar" id="tglbayar" class="form-control @error('tglbayar') is-invalid @enderror" value="{{old('tglbayar')?old('tglbayar') : $id->tglbayar}}" required>
                        @error('tglbayar')<div class="invalid-feedback"> {{$message}}</div>
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

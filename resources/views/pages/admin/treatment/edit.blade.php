@extends('layouts.default')

@section('title')
Treatment
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
            <div class="breadcrumb-item"><a href="{{route('treatment')}}">@yield('title')</a></div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h5>Edit</h5>
            </div>
            <div class="card-body">

                <form action="{{route('treatment.update',$id->id)}}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf

                    <div class="row">

                        <div class="form-group col-md-5 col-5 mt-0 ml-5">
                            <label for="nama">Nama treatment <code>*)</code></label>
                            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{old('nama')!=null?old('nama'):$id->nama}}" required>
                            @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-5 col-5 mt-0 ml-5">
                            <label for="harga">Harga<code>*)</code></label>
                            <input type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror" value="{{old('harga')!=null?old('harga'):$id->harga}}" required>
                            @error('harga')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
                        </div>
                        {{-- <div class="form-group col-md-5 col-5 mt-0 ml-5">
                            <label for="harga">Reminder <code>*) per minggu</code></label>
                            <input type="number" name="reminderweek" min="1" id="harga" class="form-control @error('reminderweek') is-invalid @enderror" value="{{old('reminderweek')?old('reminderweek'):$id->reminderweek}}" required>
                            @error('harga')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
                        </div> --}}


                        @push('after-script')
                        <script type="text/javascript">
                            $(document).ready(function() {
                              $.uploadPreview({
                                input_field: "#image-upload",   // Default: .image-upload
                                preview_box: "#image-preview",  // Default: .image-preview
                                label_field: "#image-label",    // Default: .image-label
                                label_default: "Logo Sekolah",   // Default: Choose File
                                label_selected: "Ganti Logo Sekolah",  // Default: Change File
                                no_label: false                 // Default: false
                              });



                            });
                            </script>
                        @endpush
                        <div class="form-group col-md-5 col-5 mt-0 ml-5">
                          <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label2">UPLOAD FOTO</label>
                            <input type="file" name="files" id="image-upload" class="@error('files')
                            is_invalid
                        @enderror"  accept="image/png, image/gif, image/jpeg" />

                        @error('files')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                          </div>
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

@extends('layouts.default')

@section('title')
Member
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
            <div class="breadcrumb-item"><a href="{{route('member')}}">@yield('title')</a></div>
            <div class="breadcrumb-item">Tambah</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h5>Tambah</h5>
            </div>
            <div class="card-body">

                <form action="{{route('member.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="nama">Nama member <code>*)</code></label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{old('nama')}}" required>
                        @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>


                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="jk">Pilih Jenis Kelamin <code></code></label>

                        <select class="form-control  @error('jk') is-invalid @enderror" name="jk" required>
                            <option>Laki-laki</option>
                            <option>Perempuan</option>
                        </select>
                        @error('jk')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>


                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="telp">Telp<code>*)</code></label>
                        <input type="text" name="telp" id="telp" class="form-control @error('telp') is-invalid @enderror" value="{{old('telp')}}" required>
                        @error('telp')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="tgllahir">Tanggal Lahir<code>*)</code></label>
                        <input type="date" name="tgllahir" id="tgllahir" class="form-control @error('tgllahir') is-invalid @enderror" value="{{old('tgllahir')?old('tgllahir') : date('Y-m-d')}}" required>
                        @error('tgllahir')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>


                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="alamat">Alamat<code>*)</code></label>
                        <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{old('alamat')}}" required>
                        @error('alamat')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>


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
                        <input type="file" name="memberfoto" id="image-upload" class="@error('memberfoto')
                        is_invalid
                    @enderror"  accept="image/png, image/gif, image/jpeg" />

                    @error('memberfoto')<div class="invalid-feedback"> {{$message}}</div>
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

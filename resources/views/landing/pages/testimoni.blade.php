@extends('layouts.defaultlanding')


@push('before-script')

@if (session('status'))
<x-sweetalertsession tipe="{{session('tipe')}}" status="{{session('status')}}"/>
@endif
@endpush


@section('content')

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="breadcrumb-hero">
        <div class="container">
          <div class="breadcrumb-hero">
            <h2>{{strtoupper($pages)}}</h2>
          </div>
        </div>
      </div>

      <div class="container">
        <ol>
          <li><a href="{{url('/')}}">Beranda</a></li>
          <li>{{ucfirst($pages)}}</li>
        </ol>
      </div>
      <div class="text-center mb-3">
        <a href="#tambah" class="btn btn-round btn-primary">Tambah {{ucfirst($pages)}}</a>
      </div>
    </section><!-- End Breadcrumbs -->


    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
        <div class="container mt-4">

          <div class="row">

            @forelse ($datas as $data)
            @php
            $gambar=url('assets/img/example-image.jpg');
            @endphp
            @if($data->photo!=null AND $data->photo!=url('storage') AND $data->photo!='')
            @php
                 $gambar=$data->photo;
            @endphp
            @endif
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
              <div class="member" data-aos="fade-up">
                <div class="member-img">
                  <img src="{{$gambar}}" class="img-fluid" alt="">
                  <div class="social">
                    <a href="">{{$data->member?'Member':'Belum Menjadi Member'}}</a>
                  </div>
                </div>
                <div class="member-info">
                  <h4>{{$data->member?$data->member->nama:$data->member_id}}</h4>
                  <span>{{Fungsi::tanggalindo($data->tgl)}}</span>
                  <p>{{$data->pesan}}.</p>
                </div>
              </div>
            </div>
            @empty
            <p>Data tidak ditemukan</p>
            @endforelse



            <div class="d-flex justify-content-between flex-row-reverse mt-3">
                <div class="text-right">

                    {{ $datas->onEachSide(1)
                        ->links() }}
                </div>
            </div>

          </div>

        </div>
      </section><!-- End Team Section -->


    <!-- ======= Contact Section ======= -->
    <section id="tambah" class="contact">
        <div class="container">

          <div class="row mt-5">

            <div class="col-lg-4" data-aos="fade-right">
              <div >
                <div >
                  {{-- <i class="bi bi-geo-alt"></i> --}}
                  <h4>Tambahkan Testimoni:</h4>
                </div>



              </div>

            </div>

            <div class="col-lg-8 mt-5 mt-lg-0" data-aos="fade-left">

              <form action="{{route('landing.testimoni.store')}}" method="post" role="form" >
                @csrf
                <div class="row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="member_id" class="form-control" id="name" placeholder="Nama " required>
                  </div>
                </div>
                <div class="form-group mt-3 mb-3">
                  <textarea class="form-control" name="pesan" rows="5" placeholder="Pesan" required></textarea>
                </div>
                <div class="text-center"><button type="submit" class="btn btn-round btn-info">Simpan</button></div>
              </form>

            </div>

          </div>

        </div>
      </section><!-- End Contact Section -->

  </main><!-- End #main -->

  @push('before-script')
    <script src="{{asset('/')}}assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{asset('/')}}assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  @endpush


@endsection

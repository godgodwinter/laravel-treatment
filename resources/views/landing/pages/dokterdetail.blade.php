@extends('layouts.defaultlanding')

@section('title')
Beranda
@endsection

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
            <h2>{{ucfirst($pages)}} Detail</h2>
          </div>
        </div>
      </div>
      <div class="container">
        <ol>
          <li><a href="{{url('/')}}">Beranda</a></li>
          <li><a href="{{route('landing.dokter')}}">{{ucfirst($pages)}}</a></li>
          <li>Detail</li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">

          <div class="row gy-4 justify-content-center">

            {{-- <div class="col-lg-8">
              <div class="portfolio-details-slider swiper">
                <div class="swiper-wrapper align-items-center">

                  <div class="swiper-slide">

            @php
            $gambar=url('/assets/img/example-image.jpg');
            @endphp
            @if($datas->photo!=null AND $datas->photo!=url('storage') AND $datas->photo!='')
            @php
                 $gambar=$datas->photo;
            @endphp
            @endif
                    <img src="{{$gambar}}" alt="">
                  </div>



                </div>
                <div class="swiper-pagination"></div>
              </div>
            </div> --}}

            <div class="col-lg-4">
              <div class="portfolio-info dokter-detail">
                  <div class="dokter-detail-card">
                      <img src="/assets/img/example-image.jpg" alt="{{$datas->nama}}">
                      <div class="dokter-info">
                        <h3>{{$datas->nama}}</h3>
                      </div>
                  </div>

                {{-- <h3>{{$datas->nama}}</h3>
                <ul>
                  <li><strong>Spesialisasi</strong>: {{$datas->spesialisasi}}</li>
                  <li><strong>Jenis Kelamin</strong>: {{$datas->jk}}</li>
                </ul> --}}
              </div>
              {{-- <div class="portfolio-description">
                <h2>This is an example of portfolio detail</h2>
                <p>
                  Autem ipsum nam porro corporis rerum. Quis eos dolorem eos itaque inventore commodi labore quia quia. Exercitationem repudiandae officiis neque suscipit non officia eaque itaque enim. Voluptatem officia accusantium nesciunt est omnis tempora consectetur dignissimos. Sequi nulla at esse enim cum deserunt eius.
                </p>
              </div> --}}
            </div>

          </div>

        </div>
      </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

  @push('before-script')
    <script src="{{asset('/')}}assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{asset('/')}}assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  @endpush


@endsection

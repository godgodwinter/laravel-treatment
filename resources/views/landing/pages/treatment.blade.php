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
            <h2>{{ucfirst($pages)}}</h2>
          </div>
        </div>
      </div>
      <div class="container">
        <ol>
          <li><a href="{{url('/')}}">Beranda</a></li>
          <li>{{ucfirst($pages)}}</li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="row">

          {{-- <div class="col-lg-12 d-flex justify-content-center" data-aos="fade-up">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-app">App</li>
              <li data-filter=".filter-card">Card</li>
              <li data-filter=".filter-web">Web</li>
            </ul>
          </div> --}}
        </div>

        <div class="row portfolio-container" data-aos="fade-up">
            @forelse ($datas as $data)
            @php
            $gambar=url('/assets/img/example-image.jpg');
            @endphp
            @if($data->photo!=null AND $data->photo!=url('storage') AND $data->photo!='')
            @php
                 $gambar=$data->photo;
            @endphp
            @endif
            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                <div class="portfolio-wrap">
                  <img src="{{$gambar}}" class="img-fluid" alt="">
                  <div class="portfolio-info">
                    <h4>{{$data->nama}}</h4>
                    <p>{{Fungsi::rupiah($data->harga)}}</p>
                    <div class="portfolio-links">
                      <a href="{{$gambar}}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 1"><i class="bx bx-plus"></i></a>
                      <a href="{{$gambar}}" title="More Details"><i class="bx bx-link"></i></a>
                    </div>@extends('layouts.defaultlanding')

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
                                <h2>{{ucfirst($pages)}}</h2>
                              </div>
                            </div>
                          </div>
                          <div class="container">
                            <ol>
                              <li><a href="{{url('/')}}">Beranda</a></li>
                              <li>{{ucfirst($pages)}}</li>
                            </ol>
                          </div>
                        </section><!-- End Breadcrumbs -->

                        <!-- ======= Portfolio Section ======= -->
                        <section id="portfolio" class="portfolio">
                          <div class="container">

                            <div class="row">

                              {{-- <div class="col-lg-12 d-flex justify-content-center" data-aos="fade-up">
                                <ul id="portfolio-flters">
                                  <li data-filter="*" class="filter-active">All</li>
                                  <li data-filter=".filter-app">App</li>
                                  <li data-filter=".filter-card">Card</li>
                                  <li data-filter=".filter-web">Web</li>
                                </ul>
                              </div> --}}
                            </div>

                            <div class="row portfolio-container" data-aos="fade-up">
                                @forelse ($datas as $data)
                                @php
                                $gambar=url('assets/img/example-image.jpg');
                                @endphp
                                @if($data->photo!=null AND $data->photo!=url('storage') AND $data->photo!='')
                                @php
                                     $gambar=$data->photo;
                                @endphp
                                @endif
                                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                                    <div class="portfolio-wrap">


                                      <div class="portofolio-title container">
                                          <div class="row mt-1">
                                              <div class="col-lg-8 col-md-8 col-xs-8 text-center">
                                                <p>{{Str::limit($data->nama, 10)}}</p>
                                                <span>{{Fungsi::rupiah($data->harga)}}</span>
                                              </div>
                                              <div class="col-lg-4 col-md-4 col-xs-8 text-center my-auto detail">
                                                <div class="">
                                                    <a class="btn btn-md btn-info" href="{{route('landing.treatmentdetail',$data->id)}}">Detail</a>
                                                </div>
                                              </div>
                                          </div>

                                      </div>
                                      <img src="{{$gambar}}" class="img-fluid" alt="{{$data->nama}}">
                                      <div class="portfolio-info">
                                        <a href="{{$gambar}}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 1"><i class="fas fa-expand"></i></a>
                                        {{-- <h4>{{$data->nama}}</h4>
                                        <p>{{Fungsi::rupiah($data->harga)}}</p> --}}
                                        {{-- <div class="portfolio-links">
                                          <a href="{{$gambar}}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 1"><i class="fas fa-expand"></i></a>
                                          <a href="{{$gambar}}" title="More Details"><i class="bx bx-link"></i></a>
                                        </div> --}}
                                      </div>
                                    </div>

                            {{-- <div class="d-flex justify-content-between flex-row-reverse mt-3">
                                <div class="text-right">
                                    <a class="btn btn-md btn-info" href="{{route('landing.produkdetail',$data->id)}}">Detail</a>
                                </div>
                            </div> --}}
                                  </div>

                                @empty

                                @endforelse




                            </div>

                            <div class="d-flex justify-content-between flex-row-reverse mt-3">
                                <div class="text-right">

                                    {{ $datas->onEachSide(1)
                                        ->links() }}
                                </div>
                            </div>

                          </div>
                        </section><!-- End Portfolio Section -->

                      </main><!-- End #main -->

                      @push('before-script')
                        <script src="{{asset('/')}}assets/vendor/glightbox/js/glightbox.min.js"></script>
                        <script src="{{asset('/')}}assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
                      @endpush


                    @endsection

                  </div>
                </div>

        <div class="d-flex justify-content-between flex-row-reverse mt-3">
            <div class="text-right">
                <a class="btn btn-md btn-info" href="{{route('landing.treatmentdetail',$data->id)}}">Detail</a>
            </div>
        </div>
              </div>

            @empty

            @endforelse




        </div>

        <div class="d-flex justify-content-between flex-row-reverse mt-3">
            <div class="text-right">

                {{ $datas->onEachSide(1)
                    ->links() }}
            </div>
        </div>

      </div>
    </section><!-- End Portfolio Section -->

  </main><!-- End #main -->

  @push('before-script')
    <script src="{{asset('/')}}assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{asset('/')}}assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  @endpush


@endsection

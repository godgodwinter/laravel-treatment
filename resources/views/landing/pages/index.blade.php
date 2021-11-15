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

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">

          <div class="row justify-content-end">
            <div class="col-lg-11">
              <div class="row justify-content-end">

                <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
                  <div class="count-box py-5">
                    <i class="fas fa-cubes"></i>
                    <span data-purecounter-start="0" data-purecounter-end="14" class="purecounter">0</span>
                    <p>Produk</p>
                  </div>
                </div>

                <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
                  <div class="count-box py-5">

                    <i class="fas fa-vial"></i>
                    <span data-purecounter-start="0" data-purecounter-end="23" class="purecounter">0</span>
                    <p>Treatment</p>
                  </div>
                </div>

                <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
                  <div class="count-box pb-5 pt-0 pt-lg-5">
                      <i class="far fa-smile-beam"></i>
                    <span data-purecounter-start="0" data-purecounter-end="2" class="purecounter">0</span>
                    <p>Member</p>
                  </div>
                </div>

                <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
                  <div class="count-box pb-5 pt-0 pt-lg-5">
                      <i class="fas fa-user-tag"></i>
                    <span data-purecounter-start="0" data-purecounter-end="22" class="purecounter">0</span>
                    <p>Dokter</p>
                  </div>
                </div>

              </div>
            </div>
          </div>


        </div>
      </section><!-- End About Section -->


      <!-- ======= Services Section ======= -->
      <section id="services" class="services ">
        <div class="container">

          <div class="section-title pt-5" data-aos="fade-up">
            <h2>Our Services</h2>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="icon-box" data-aos="fade-up">
                <div class="icon"><i class="fab fa-laravel"></i></div>
                <h4 class="title"><a href="">Produk Perawatan</a></h4>
                <p class="description">Menjual produk perawatan terbaik. </p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="icon-box" data-aos="fade-up">
                <div class="icon"><i class="fas fa-paw"></i></div>
                <h4 class="title"><a href="">Treatment</a></h4>
                <p class="description">Melayani Proses Perawatan dan konsultasi dengan Dokter Terbaik di bidangnya.</p>
              </div>

          </div>

        </div>
      </section><!-- End Services Section -->




      <!-- ======= Our Clients Section ======= -->
      <section id="clients" class="clients">
          <div class="container" data-aos="fade-up">

            <div class="section-title">
              <h2>Our Clients</h2>
              <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
            </div>

            <div class="clients-slider swiper">
              <div class="swiper-wrapper align-items-center">
                <div class="swiper-slide"><img src="{{ asset('/') }}assets/img/clients/client-1.png" class="img-fluid" alt=""></div>
                <div class="swiper-slide"><img src="{{ asset('/') }}assets/img/clients/client-2.png" class="img-fluid" alt=""></div>
                <div class="swiper-slide"><img src="{{ asset('/') }}assets/img/clients/client-3.png" class="img-fluid" alt=""></div>
                <div class="swiper-slide"><img src="{{ asset('/') }}assets/img/clients/client-4.png" class="img-fluid" alt=""></div>
                <div class="swiper-slide"><img src="{{ asset('/') }}assets/img/clients/client-5.png" class="img-fluid" alt=""></div>
                <div class="swiper-slide"><img src="{{ asset('/') }}assets/img/clients/client-6.png" class="img-fluid" alt=""></div>
                <div class="swiper-slide"><img src="{{ asset('/') }}assets/img/clients/client-7.png" class="img-fluid" alt=""></div>
                <div class="swiper-slide"><img src="{{ asset('/') }}assets/img/clients/client-8.png" class="img-fluid" alt=""></div>
              </div>
              <div class="swiper-pagination"></div>
            </div>

          </div>
        </section><!-- End Our Clients Section -->


@endsection

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

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container" data-aos="fade-up">
      <h1>{{Fungsi::app_nama()}}</h1>
      <h2>Perawatan wajah dan tubuh terapi jerawat</h2>
      {{-- <a href="#about" class="btn-get-started scrollto">Get Started</a> --}}
    </div>
  </section><!-- End Hero -->

<main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">

          <div class="row justify-content-evenly">
            <div class="col-lg-12">
              <div class="row justify-content-between">
                <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
                  <div class="count-box py-5 text-center d-flex justify-content-center align-middle">

                    <i class="fas fa-cube align-middle pe-2"></i>
                    <div id="container">
                    <a href="{{route('landing.produk')}}" class="d-inline">
                        <span data-purecounter-start="0" data-purecounter-end="{{$jmlproduk?$jmlproduk:'0'}}" class="purecounter">0</span>
                        <p>Produk</p>
                </a>

                    </div>
                  </div>

                </div>

                <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
                  <div class="count-box py-5 text-center d-flex justify-content-center align-middle">
                    <i class="fas fa-hand-holding-heart align-middle pe-2"></i>
                    <div id="container">
                    <a href="{{route('landing.treatment')}}" class="d-inline">
                        <span data-purecounter-start="0" data-purecounter-end="{{$jmltreatment?$jmltreatment:'0'}}" class="purecounter">0</span>
                        <p>Treatment</p>
                    </a>
                    </div>
                  </div>
                </div>

                <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
                  <div class="count-box py-5 text-center d-flex justify-content-center align-middle">
                    <i class="fas fa-user align-middle pe-2"></i>
                    <div id="container">
                    <a href="{{route('landing.testimoni')}}" class="d-inline">
                        <span data-purecounter-start="0" data-purecounter-end="{{$jmlmember?$jmlmember:'0'}}" class="purecounter">0</span>
                        <p>Member</p>
                    </a>
                    </div>
                  </div>
                </div>

                <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
                  <div class="count-box py-5 text-center d-flex justify-content-center align-middle">
                    <i class="fas fa-user-nurse align-middle pe-2"></i>
                    <div id="container">
                    <a href="{{route('landing.dokter')}}" class="d-inline">
                        <span data-purecounter-start="0" data-purecounter-end="{{$jmldokter?$jmldokter:'0'}}" class="purecounter">0</span>
                        <p>Dokter</p>
                    </a>
                    </div>
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
            <h2>Melayani</h2>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="icon-box" data-aos="fade-up">
                <div class="icon"><i class="fas fa-hand-holding-heart"></i></div>
                <h4 class="title"><a href="{{route('landing.produk')}}">Produk Perawatan</a></h4>
                <p class="description">Menjual produk perawatan terbaik. </p>
              </div>
            </div>

            <div class="col-md-6">
              <div class="icon-box" data-aos="fade-up">
                <div class="icon"><i class="fas fa-user-nurse"></i></div>
                <h4 class="title"><a href="{{route('landing.treatment')}}">Treatment</a></h4>
                <p class="description">Melayani Proses Perawatan dan konsultasi dengan Dokter Terbaik di bidangnya.</p>
              </div>

          </div>

        </div>
      </section><!-- End Services Section -->




      <!-- ======= Our Clients Section ======= -->
      <section id="clients" class="clients">
          <div class="container" data-aos="fade-up">

            <div class="section-title">
              <h2>Testimoni</h2>
              <p>Apa yang dikatakan pelanggan tentang {{Fungsi::app_nama()}}</p>
            </div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="clients-slider swiper">
                            <div class="swiper-wrapper">
                                @forelse ($testimoni as $t)
                                @php
                                // $gambar=url('assets/img/example-image.jpg');
                                $gambar=asset('assets/img/avatar/avatar-3.png');
                                @endphp
                                @if($t->member!=null AND $t->member->photo!=url('storage') AND $t->member->photo!='')
                                @php
                                     $gambar=$t->member->photo;
                                @endphp
                                @endif
                                <div class="swiper-slide d-flex flex-column align-items-center justify-content-center px-2">
                                    <div class="col-md-12 justify-content-center">
                                      <p class="text-center">
                                          {{$t->pesan}}
                                      </p>
                                    </div>
                                    <div class="col-md-12 px-auto d-flex justify-content-center">
                                      <img src="{{$gambar}}" alt="namaPelanggan">
                                  </div>
                                    <div class="col-md-12 justify-content-center">
                                        <h6 class="text-center">
                                           {{$t->member!=null?$t->member->nama:$t->member_id}}
                                        </h6>
                                    </div>
                                </div>

                                @empty
                                <div class="swiper-slide d-flex flex-column align-items-center justify-content-center px-2">
                                    <div class="col-md-12 justify-content-center">
                                        <p class="text-center">
                                            Lorem ipsum dolor
                                        </p>
                                      </div>
                                      <div class="col-md-12 px-auto d-flex justify-content-center">
                                        <img src="{{asset('assets/img/avatar/avatar-3.png')}}" alt="namaPelanggan">
                                    </div>
                                      <div class="col-md-12 justify-content-center">
                                          <h6 class="text-center">
                                              Bambang Gentolet
                                          </h6>
                                      </div>
                                  </div>

                                @endforelse
                              {{-- <div class="swiper-slide d-flex flex-column align-items-center justify-content-center px-2">
                                <div class="col-md-12 justify-content-center">
                                    <p class="text-center">
                                        Lorem ipsum dolor
                                    </p>
                                  </div>
                                  <div class="col-md-12 px-auto d-flex justify-content-center">
                                    <img src="{{asset('assets/img/avatar/avatar-3.png')}}" alt="namaPelanggan">
                                </div>
                                  <div class="col-md-12 justify-content-center">
                                      <h6 class="text-center">
                                          Bambang Gentolet
                                      </h6>
                                  </div>
                              </div> --}}
                              {{-- <div class="swiper-slide d-flex flex-column align-items-center justify-content-center px-2">
                                <div class="col-md-12 justify-content-center">
                                    <p class="text-center">
                                        Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum
                                    </p>
                                  </div>
                                  <div class="col-md-12 px-auto d-flex justify-content-center">
                                    <img src="{{asset('assets/img/avatar/avatar-3.png')}}" alt="namaPelanggan">
                                </div>
                                  <div class="col-md-12 justify-content-center">
                                      <h6 class="text-center">
                                          Bambang Gentolet
                                      </h6>
                                  </div>
                              </div> --}}
                          </div>
                            {{-- <div class="swiper-pagination"></div> --}}
                          </div>
                    </div>
                </div>
            </div>


          </div>
        </section><!-- End Our Clients Section -->
    </main><!-- End #main -->


@endsection

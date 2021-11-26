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
            <h2>{{ucfirst($pages)}} </h2>
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


    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
        <div class="container">

          {{-- <div class="section-title" data-aos="fade-up">
            <h2>Jadwal Perawatan</h2>
          </div> --}}
          @forelse ($datas as $data)

          <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up">
            <div class="col-lg-5">
              <i class="bx bx-help-circle"></i>
              <h4>{{$data->hari}}</h4>
            </div>
            <div class="col-lg-7">
                @forelse ($data->jam as $jam)
                    <button class="btn btn-light">{{$jam->nama}}</button>
                @empty

                @endforelse
            </div>
          </div><!-- End F.A.Q Item-->

          @empty

          @endforelse


        </div>

      </section><!-- End Frequently Asked Questions Section -->

      <section>

        <div class="section-title mt-5" data-aos="fade-up">
            <h2>Ruangan Tersedia</h2>
            @forelse ($ruang as $r)
                 <button class="btn btn-info">Ruang {{$r->nama}}</button>
            @empty

            @endforelse
        </div>
      </section>


  </main><!-- End #main -->

  @push('before-script')
    <script src="{{asset('/')}}assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{asset('/')}}assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  @endpush


@endsection

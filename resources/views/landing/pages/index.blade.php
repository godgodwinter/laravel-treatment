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
                      <i class="far fa-smile-beam"></i>
                    <span data-purecounter-start="0" data-purecounter-end="14" class="purecounter">0</span>
                    <p>Happy Clients</p>
                  </div>
                </div>

                <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
                  <div class="count-box py-5">
                      <i class="fas fa-cubes"></i>
                    <span data-purecounter-start="0" data-purecounter-end="23" class="purecounter">0</span>
                    <p>Projects</p>
                  </div>
                </div>

                <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
                  <div class="count-box pb-5 pt-0 pt-lg-5">
                      <i class="fas fa-vial"></i>
                    <span data-purecounter-start="0" data-purecounter-end="2" class="purecounter">0</span>
                    <p>Years of experience</p>
                  </div>
                </div>

                <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
                  <div class="count-box pb-5 pt-0 pt-lg-5">
                      <i class="fas fa-user-tag"></i>
                    <span data-purecounter-start="0" data-purecounter-end="22" class="purecounter">0</span>
                    <p>Dev</p>
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
                <h4 class="title"><a href="">Laravel</a></h4>
                <p class="description">Web Application Simple or Complex App, RestFull API, Full Responsive, etc. </p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="icon-box" data-aos="fade-up">
                <div class="icon"><i class="fab fa-android"></i></div>
                <h4 class="title"><a href="">Game App</a></h4>
                <p class="description">Android and Desktop</p>
              </div>
            </div>

            <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
              <div class="icon-box">
                <div class="icon"><i class="fas fa-paw"></i></div>
                <h4 class="title"><a href="">Animation</a></h4>
                <p class="description">Story and Character Animation</p>
              </div>
            </div>
          </div>

        </div>
      </section><!-- End Services Section -->


      <!-- ======= Our Skills Section ======= -->
      <section id="skills" class="skills section-bg">
          <div class="container">

            <div class="section-title" data-aos="fade-up">
              <h2>Our Skills</h2>
              <p>Never stop learning.</p>
            </div>

            <div class="row">
              <div class="col-lg-6" data-aos="fade-right">
                <img src="{{ asset('/') }}assets/img/undraw_thought_process_re_om58.svg" class="img-fluid" alt="">
              </div>
              <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left">
                <h3>Voluptatem dignissimos provident quasi corporis voluptates</h3>
                <p class="fst-italic">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                  magna aliqua.
                </p>
                <p>
                  Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.
                </p>

                <div class="skills-content">

                  <div class="progress">
                    <span class="skill">HTML <i class="val">100%</i></span>
                    <div class="progress-bar-wrap">
                      <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>

                  <div class="progress">
                    <span class="skill">CSS <i class="val">90%</i></span>
                    <div class="progress-bar-wrap">
                      <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>

                  <div class="progress">
                    <span class="skill">JavaScript <i class="val">75%</i></span>
                    <div class="progress-bar-wrap">
                      <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>

                  <div class="progress">
                    <span class="skill">Photoshop <i class="val">55%</i></span>
                    <div class="progress-bar-wrap">
                      <div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>

                </div>

              </div>
            </div>

          </div>
        </section><!-- End Our Skills Section -->

         <!-- ======= Work Process Section ======= -->
         <section id="work-process" class="work-process">
          <div class="container">

            <div class="section-title" data-aos="fade-up">
              <h2>Work Process</h2>
              <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
            </div>

            <div class="row content">
              <div class="col-md-5" data-aos="fade-right">
                <img src="{{ asset('/') }}assets/img/undraw_add_information_j2wg.svg" class="img-fluid" alt="">
              </div>
              <div class="col-md-7 pt-4" data-aos="fade-left">
                <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
                <p class="fst-italic">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                  magna aliqua.
                </p>
                <ul>
                  <li><i class="bi bi-check"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                  <li><i class="bi bi-check"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                </ul>
              </div>
            </div>

            <div class="row content">
              <div class="col-md-5 order-1 order-md-2" data-aos="fade-left">
                <img src="{{ asset('/') }}assets/img/undraw_control_panel_re_y3ar.svg" class="img-fluid" alt="">
              </div>
              <div class="col-md-7 pt-5 order-2 order-md-1" data-aos="fade-right">
                <h3>Corporis temporibus maiores provident</h3>
                <p class="fst-italic">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                  magna aliqua.
                </p>
                <p>
                  Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                  culpa qui officia deserunt mollit anim id est laborum
                </p>
              </div>
            </div>

            <div class="row content">
              <div class="col-md-5" data-aos="fade-right">
                <img src="{{ asset('/') }}assets/img/undraw_firmware_re_fgdy.svg" class="img-fluid" alt="">
              </div>
              <div class="col-md-7 pt-5" data-aos="fade-left">
                <h3>Sunt consequatur ad ut est nulla consectetur reiciendis animi voluptas</h3>
                <p>Cupiditate placeat cupiditate placeat est ipsam culpa. Delectus quia minima quod. Sunt saepe odit aut quia voluptatem hic voluptas dolor doloremque.</p>
                <ul>
                  <li><i class="bi bi-check"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                  <li><i class="bi bi-check"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                  <li><i class="bi bi-check"></i> Facilis ut et voluptatem aperiam. Autem soluta ad fugiat.</li>
                </ul>
              </div>
            </div>

            <div class="row content">
              <div class="col-md-5 order-1 order-md-2" data-aos="fade-left">
                <img src="{{ asset('/') }}assets/img/undraw_message_sent_re_q2kl.svg" class="img-fluid" alt="">
              </div>
              <div class="col-md-7 pt-5 order-2 order-md-1" data-aos="fade-right">
                <h3>Quas et necessitatibus eaque impedit ipsum animi consequatur incidunt in</h3>
                <p class="fst-italic">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                  magna aliqua.
                </p>
                <p>
                  Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                  culpa qui officia deserunt mollit anim id est laborum
                </p>
              </div>
            </div>

          </div>
        </section><!-- End Work Process Section -->


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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ !empty($pages)?$pages:'' }} {{ Fungsi::app_nama() }}</title>

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


  @stack('before-style')

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- <link href="{{ asset('/') }}assets/vendor/aos/aos.css" rel="stylesheet"> -->
    <!-- <link href="{{ asset('/') }}assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="{{ asset('/') }}assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <!-- <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet"> -->
    <link href="{{ asset('/') }}assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('/') }}assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('/') }}assets/css/landing.css">
  <link rel="stylesheet" href="{{ asset('/') }}assets/css/baemon.css">

  @stack('after-style')

</head>

<body>

  <div id="app">

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1 class="text-light"><a href="{{ url('/') }}">{{ Fungsi::app_nama() }}</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>
      @include('landing.includes.navbar')
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container" data-aos="fade-up">
      <!-- <h1>Baemon DEV </h1>
      <h2>We Build Everything With Love</h2>
      <a href="#about" class="btn-get-started scrollto">Get Started</a> -->
    </div>
  </section><!-- End Hero -->

  <main id="main">

    @yield('content')
    @yield('containermodal')


  </main><!-- End #main -->


  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <h3>{{ Fungsi::lembaga_nama() }}</h3>
            <p>{{ Fungsi::lembaga_jalan() }}</p>
          </div>



          <div class="col-lg-3 col-md-6 offset-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              Indonesia<br>
              <strong>Telp:</strong> {{ Fungsi::lembaga_telp() }}<br>
              <strong>Alamat:</strong> {{ Fungsi::lembaga_jalan() }}<br>
            </p>

            <div class="social-links">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>

          </div>


        </div>
      </div>
    </div>

    @php
    // exec('git rev-parse --verify HEAD 2> /dev/null', $output);
    // $hash = $output[0];
    // dd($hash)

    $commitHash = trim(exec('git log --pretty="%h" -n1 HEAD'));

    $commitDate = new \DateTime(trim(exec('git log -n1 --pretty=%ci HEAD')));
    $commitDate->setTimezone(new \DateTimeZone('UTC'));

    // dd($commitDate);
    // dd($commitDate->format('Y-m-d H:i:s'));
    $versi=$commitDate->format('Ymd.H.i.s');
@endphp
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>{{ Fungsi::app_nama() }}</span></strong>. All Rights Reserved  v1. {{ $versi }}
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></a>


  </div>


  @stack('before-script')

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="{{ asset('/') }}assets/js/baemon.js"></script>

  <!-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> -->
  <!-- <script>
    AOS.init();
  </script> -->

  <script src="{{ asset('/') }}assets/vendor/aos/aos.js"></script>
  <script src="{{ asset('/') }}assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('/') }}assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="{{ asset('/') }}assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="{{ asset('/') }}assets/vendor/php-email-form/validate.js"></script>
  <script src="{{ asset('/') }}assets/vendor/purecounter/purecounter.js"></script>
  <script src="{{ asset('/') }}assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="{{ asset('/') }}assets/vendor/waypoints/noframework.waypoints.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('/') }}assets/js/landing.js"></script>

  @stack('after-script')
  <!-- Page Specific JS File -->
</body>
</html>

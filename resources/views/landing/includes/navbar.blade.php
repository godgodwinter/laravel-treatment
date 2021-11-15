<nav id="navbar" class="navbar">
    <ul>
      <li><a class="active" href="index.html">Beranda</a></li>
      {{-- <li class="dropdown"><a href="#"><span>Portofolio</span> <i class="bi bi-chevron-down"></i></a>
        <ul>
            <li class="dropdown"><a href="#"><span>Website</span> <i class="bi bi-chevron-right"></i></a>
              <ul>
                <li><a href="#">Laravel</a></li>
                <li><a href="#">Vue</a></li>
                <li><a href="#">React</a></li>
                <li><a href="#">Tailwind</a></li>
                <li><a href="#">Native</a></li>
              </ul>
            </li>
          <li><a href="#">Animasi</a></li>
          <li><a href="#">Game</a></li>
        </ul>
      </li> --}}
      <li><a href="{{route('landing.produk')}}">Produk</a></li>
      <li><a href="{{route('landing.treatment')}}">Treatment</a></li>
      <li><a href="{{route('landing.jadwal')}}">Jadwal Perawatan</a></li>
      <li><a href="{{route('landing.testimoni')}}">Testimoni</a></li>

      <li><a class="getstarted" href="{{ url('/login') }}">Masuk</a></li>
    </ul>
    <i class="bi bi-list mobile-nav-toggle"></i>
  </nav><!-- .navbar -->


            <li {{$pages=='dashboard' ? 'class=active' : ''}}><a class="nav-link" href="{{route('dashboard')}}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            <li class="nav-item dropdown {{$pages=='settings' || $pages=='resetpassword' || $pages=='passwordujian'  ? 'active' : ''}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cog"></i> <span>Pengaturan</span></a>
                <ul class="dropdown-menu">

                    <li {{$pages=='settings' ? 'class=active' : ''}}><a class="nav-link" href="{{route('settings')}}"><i class="fas fa-cog"></i> <span>Aplikasi</span></a></li>
                  </ul>
            </li>
            <li class="nav-item dropdown {{$pages=='users' || $pages=='tapel' || $pages=='siswa' || $pages=='guru'|| $pages=='kelas' || $pages=='guru' || $pages=='mapel' ? 'active' : ''}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-dumpster"></i>  <span>Mastering</span></a>
                <ul class="dropdown-menu">

                    <li {{$pages=='tapel' ? 'class=active' : ''}}><a class="nav-link" href="{{route('produk')}}"><i class="fas fa-passport"></i> <span>Produk</span></a></li>
                    <li {{$pages=='kelas' ? 'class=active' : ''}}><a class="nav-link" href="#"><i class="fas fa-school"></i><span>Treatment</span></a></li>
                    <li {{$pages=='siswa' ? 'class=active' : ''}}><a class="nav-link" href="#"><i class="fas fa-user-graduate"></i><span>Dokter</span></a></li>
                    <li {{$pages=='guru' ? 'class=active' : ''}}><a class="nav-link" href="#"><i class="fas fa-chalkboard-teacher"></i><span>Member</span></a></li>
                    <li {{$pages=='users' ? 'class=active' : ''}}><a class="nav-link" href="{{route('users')}}"><i class="fas fa-building"></i> <span>User</span></a></li>
                </ul>
            </li>

            <li class="nav-item dropdown {{$pages=='mapel' || $pages=='silabus' || $pages=='penilaian' ? 'active' : ''}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>   <span>Proses</span></a>
                <ul class="dropdown-menu">

                    <li {{$pages=='mapel' ? 'class=active' : ''}}><a class="nav-link" href="#"><i class="fab fa-monero"></i> <span>Perawatan</span></a></li>
                    <li {{$pages=='silabus' ? 'class=active' : ''}}><a class="nav-link" href="#"><i class="fas fa-microchip"></i> <span>Penjadwalan</span></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown  {{$pages=='absensi' || $pages=='pelanggaran'  ? 'active' : ''}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-id-card-alt"></i>  <span>Laporan</span></a>
                <ul class="dropdown-menu">

                    <li {{$pages=='absensi' ? 'class=active' : ''}}><a class="nav-link" href="#"><i class="fas fa-id-card-alt"></i><span>Rekap Pembayaran</span></a></li>
                    <li {{$pages=='pelanggaran' ? 'class=active' : ''}}><a class="nav-link" href="#"><i class="fas fa-times-circle"></i><span>Rekap Perawatan</span></a></li>
                </ul>
            </li>



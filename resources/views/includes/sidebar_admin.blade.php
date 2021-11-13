<li {{ $pages == 'dashboard' ? 'class=active' : '' }}><a class="nav-link" href="{{ route('dashboard') }}"><i
            class="fas fa-home"></i> <span>Dashboard</span></a></li>
<li
    class="nav-item dropdown {{ $pages == 'settings' || $pages == 'resetpassword' || $pages == 'passwordujian' ? 'active' : '' }}">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cog"></i>
        <span>Pengaturan</span></a>
    <ul class="dropdown-menu">

        <li {{ $pages == 'settings' ? 'class=active' : '' }}><a class="nav-link" href="{{ route('settings') }}"><i
                    class="fas fa-cog"></i> <span>Aplikasi</span></a></li>
    </ul>
</li>
<li
    class="nav-item dropdown {{ $pages == 'users' || $pages == 'produk' || $pages == 'treatment' || $pages == 'dokter' || $pages == 'member' || $pages == 'jadwaltreatment' || $pages== 'ruangan' ? 'active' : '' }}">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-dumpster"></i>
        <span>Mastering</span></a>
    <ul class="dropdown-menu">

        <li {{ $pages == 'produk' ? 'class=active' : '' }}><a class="nav-link" href="{{ route('produk') }}"><i
                    class="fas fa-passport"></i> <span>Produk</span></a></li>
        <li {{ $pages == 'treatment' ? 'class=active' : '' }}><a class="nav-link" href="{{ route('treatment') }}"><i
                    class="fas fa-school"></i><span>Treatment</span></a></li>
        <li {{ $pages == 'dokter' ? 'class=active' : '' }}><a class="nav-link" href="{{ route('dokter') }}"><i
                    class="fas fa-user-graduate"></i><span>Dokter</span></a></li>
        <li {{ $pages == 'member' ? 'class=active' : '' }}><a class="nav-link" href="{{ route('member') }}"><i
                    class="fas fa-chalkboard-teacher"></i><span>Member</span></a></li>
        <li {{ $pages == 'ruangan' ? 'class=active' : '' }}><a class="nav-link"
                href="{{ route('ruangan') }}"><i class="fas fa-chalkboard-teacher"></i><span>
                    Ruangan </span></a></li>
        <li {{ $pages == 'jadwaltreatment' ? 'class=active' : '' }}><a class="nav-link"
                href="{{ route('jadwaltreatment') }}"><i class="fas fa-chalkboard-teacher"></i><span>Jadwal
                    Treatment</span></a></li>
        <li {{ $pages == 'users' ? 'class=active' : '' }}><a class="nav-link" href="{{ route('users') }}"><i
                    class="fas fa-building"></i> <span>User</span></a></li>
    </ul>
</li>

<li class="nav-item dropdown {{ $pages == 'mapel' || $pages == 'silabus' || $pages == 'penilaian' ? 'active' : '' }}">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
        <span>Proses</span></a>
    <ul class="dropdown-menu">

        <li {{ $pages == 'perawatan' ? 'class=active' : '' }}><a class="nav-link" href="{{route('perawatan')}}"><i
                    class="fab fa-monero"></i> <span>Perawatan</span></a></li>
        <li {{ $pages == 'penjadwalan' ? 'class=active' : '' }}><a class="nav-link" href="{{route('penjadwalan')}}"><i
                    class="fas fa-microchip"></i> <span>Penjadwalan</span></a></li>
    </ul>
</li>
<li class="nav-item dropdown  {{ $pages == 'absensi' || $pages == 'pelanggaran' ? 'active' : '' }}">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-id-card-alt"></i>
        <span>Laporan</span></a>
    <ul class="dropdown-menu">

        <li {{ $pages == 'absensi' ? 'class=active' : '' }}><a class="nav-link" href="#"><i
                    class="fas fa-id-card-alt"></i><span>Rekap Pembayaran</span></a></li>
        <li {{ $pages == 'pelanggaran' ? 'class=active' : '' }}><a class="nav-link" href="#"><i
                    class="fas fa-times-circle"></i><span>Rekap Perawatan</span></a></li>
    </ul>
</li>

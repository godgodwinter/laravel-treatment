<li {{ $pages == 'dashboard' ? 'class=active' : '' }}><a class="nav-link" href="{{ route('dashboard') }}"><i
            class="fas fa-home"></i> <span>Dashboard</span></a></li>


<li {{ $pages == 'transaksi' ? 'class=active' : '' }}><a class="nav-link" href="{{ route('transaksi') }}"><i class="fas fa-cart-arrow-down"></i><span>Keranjang</span></a></li>

<li {{ $pages == 'transaksi' ? 'class=active' : '' }}><a class="nav-link" href="{{ route('transaksi') }}"><i class="fas fa-cart-arrow-down"></i><span>Invoice</span></a></li>

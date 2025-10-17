<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item sidebar-category">
      <p>Navigation</p>
      <span></span>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="mdi mdi-view-quilt menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <li class="nav-item sidebar-category">
      <p>Cabang</p>
      <span></span>
    </li>

    {{-- CABANG BANJARBARU --}}
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#banjarbaru" aria-expanded="false" aria-controls="banjarbaru">
        <i class="mdi mdi-store menu-icon"></i>
        <span class="menu-title">Banjarbaru</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="banjarbaru">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> 
            <a class="nav-link" href="{{ route('banjarbaru.barang') }}">Data Barang</a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="{{ route('banjarbaru.stok') }}">Stok</a>
          </li>
        </ul>
      </div>
    </li>

    {{-- CABANG MARTAPURA --}}
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#martapura" aria-expanded="false" aria-controls="martapura">
        <i class="mdi mdi-factory menu-icon"></i>
        <span class="menu-title">Martapura</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="martapura">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> 
            <a class="nav-link" href="{{ route('martapura.barang') }}">Data Barang</a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="{{ route('martapura.stok') }}">Stok</a>
          </li>
        </ul>
      </div>
    </li>

    {{-- CABANG LIANG ANGGANG --}}
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#lianganggang" aria-expanded="false" aria-controls="lianganggang">
        <i class="mdi mdi-store menu-icon"></i>
        <span class="menu-title">Liang Anggang</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="lianganggang">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> 
            <a class="nav-link" href="{{ route('lianganggang.barang') }}">Data Barang</a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="{{ route('lianganggang.stok') }}">Stok</a>
          </li>
        </ul>
      </div>
    </li>

    <li class="nav-item sidebar-category">
      <p>Gudang Utama</p>
      <span></span>
    </li>

    {{-- GUDANG PUSAT --}}
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#gudang" aria-expanded="false" aria-controls="gudang">
        <i class="mdi mdi-store menu-icon"></i>
        <span class="menu-title">Gudang</span>
        <i class="menu-arrow"></i>
      </a> 
      <div class="collapse" id="gudang">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> 
            <a class="nav-link" href="{{ route('gudang.barang') }}">Data Barang</a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="{{ route('gudang.stok') }}">Stok</a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="{{ route('gudang.pengiriman') }}">Pengiriman</a>
          </li>
        </ul>
      </div>
    </li>
  </ul>
</nav>

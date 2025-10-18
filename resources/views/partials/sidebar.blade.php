<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item sidebar-category">
      <p>Navigation</p>
      <span></span>
    </li>

    {{-- === DASHBOARD === --}}
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
        <i class="mdi mdi-view-quilt menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    {{-- === CABANG === --}}
    <li class="nav-item sidebar-category">
      <p>Cabang</p>
      <span></span>
    </li>

    @php
      use Illuminate\Support\Facades\Route;
      use Illuminate\Support\Str;

      // Ambil prefix route aktif, misalnya "banjarbaru" dari "banjarbaru.barang"
      $currentPrefix = explode('.', Route::currentRouteName())[0] ?? '';
    @endphp

    {{-- === BANJARBARU === --}}
    @php $banjarActive = $currentPrefix === 'banjarbaru'; @endphp
    <li class="nav-item">
      <a class="nav-link sidebar-toggle {{ $banjarActive ? '' : 'collapsed' }}" href="#menu-banjarbaru" aria-expanded="{{ $banjarActive ? 'true' : 'false' }}">
        <i class="mdi mdi-store menu-icon"></i>
        <span class="menu-title">Banjarbaru</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ $banjarActive ? 'show' : '' }}" id="menu-banjarbaru">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('banjarbaru.barang') ? 'active' : '' }}" href="{{ route('banjarbaru.barang') }}">Data Barang</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('banjarbaru.stok') ? 'active' : '' }}" href="{{ route('banjarbaru.stok') }}">Stok</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('banjarbaru.riwayat') ? 'active' : '' }}" href="{{ route('banjarbaru.riwayat') }}">Riwayat Pengiriman</a></li>
        </ul>
      </div>
    </li>

    {{-- === MARTAPURA === --}}
    @php $martapuraActive = $currentPrefix === 'martapura'; @endphp
    <li class="nav-item">
      <a class="nav-link sidebar-toggle {{ $martapuraActive ? '' : 'collapsed' }}" href="#menu-martapura" aria-expanded="{{ $martapuraActive ? 'true' : 'false' }}">
        <i class="mdi mdi-factory menu-icon"></i>
        <span class="menu-title">Martapura</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ $martapuraActive ? 'show' : '' }}" id="menu-martapura">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('martapura.barang') ? 'active' : '' }}" href="{{ route('martapura.barang') }}">Data Barang</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('martapura.stok') ? 'active' : '' }}" href="{{ route('martapura.stok') }}">Stok</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('martapura.riwayat') ? 'active' : '' }}" href="{{ route('martapura.riwayat') }}">Riwayat Pengiriman</a></li>
        </ul>
      </div>
    </li>

    {{-- === LIANG ANGGANG === --}}
    @php $liangActive = $currentPrefix === 'lianganggang'; @endphp
    <li class="nav-item">
      <a class="nav-link sidebar-toggle {{ $liangActive ? '' : 'collapsed' }}" href="#menu-liang" aria-expanded="{{ $liangActive ? 'true' : 'false' }}">
        <i class="mdi mdi-store menu-icon"></i>
        <span class="menu-title">Liang Anggang</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ $liangActive ? 'show' : '' }}" id="menu-liang">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('lianganggang.barang') ? 'active' : '' }}" href="{{ route('lianganggang.barang') }}">Data Barang</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('lianganggang.stok') ? 'active' : '' }}" href="{{ route('lianganggang.stok') }}">Stok</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('lianganggang.riwayat') ? 'active' : '' }}" href="{{ route('lianganggang.riwayat') }}">Riwayat Pengiriman</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item sidebar-category">
      <p>Gudang Utama</p>
      <span></span>
    </li>

    {{-- === GUDANG PUSAT === --}}
    @php $gudangActive = $currentPrefix === 'gudangpusat'; @endphp
    <li class="nav-item">
      <a class="nav-link sidebar-toggle {{ $gudangActive ? '' : 'collapsed' }}" href="#menu-gudangpusat" aria-expanded="{{ $gudangActive ? 'true' : 'false' }}">
        <i class="mdi mdi-warehouse menu-icon"></i>
        <span class="menu-title">Gudang Pusat</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ $gudangActive ? 'show' : '' }}" id="menu-gudangpusat">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('gudangpusat.barang') ? 'active' : '' }}" href="{{ route('gudangpusat.barang') }}">Data Barang</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('gudangpusat.stok') ? 'active' : '' }}" href="{{ route('gudangpusat.stok') }}">Stok</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('gudangpusat.pengiriman') ? 'active' : '' }}" href="{{ route('gudangpusat.pengiriman') }}">Pengiriman</a></li>
        </ul>
      </div>
    </li>
  </ul>
</nav>

<script>
(function () {
  if (!window.bootstrap || !bootstrap.Collapse) return;

  // --- Fungsi bantu: tutup semua dropdown kecuali yang diklik
  function closeOtherMenus(current) {
    document.querySelectorAll('.collapse.show').forEach(opened => {
      if (opened !== current) {
        const inst = bootstrap.Collapse.getInstance(opened);
        if (inst) inst.hide();
      }
    });
  }

  // --- Inisialisasi panah sesuai kondisi awal
  document.querySelectorAll('.sidebar-toggle').forEach(toggler => {
    const target = document.querySelector(toggler.getAttribute('href'));
    const arrow = toggler.querySelector('.menu-arrow');
    if (target && target.classList.contains('show')) arrow.classList.add('rotate');
  });

  // --- Event buka/tutup menu
  document.querySelectorAll('.collapse').forEach(col => {
    col.addEventListener('show.bs.collapse', function () {
      closeOtherMenus(this); // tutup menu lain
      const arrow = document.querySelector(`a.sidebar-toggle[href="#${this.id}"] .menu-arrow`);
      arrow?.classList.add('rotate');
    });

    col.addEventListener('hide.bs.collapse', function () {
      const arrow = document.querySelector(`a.sidebar-toggle[href="#${this.id}"] .menu-arrow`);
      arrow?.classList.remove('rotate');
    });
  });

  // --- Klik handler (toggle manual agar animasi tidak bentrok)
  document.querySelectorAll('.sidebar-toggle').forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      const instance = bootstrap.Collapse.getOrCreateInstance(target, { toggle: false });
      const isOpen = target.classList.contains('show');
      if (isOpen) instance.hide(); else instance.show();
    });
  });
})();
</script>

<style>
/* Rotasi panah */
.menu-arrow {
  transition: transform 0.3s ease, color 0.2s ease;
  display: inline-block;
  margin-left: auto;
}
.menu-arrow.rotate { transform: rotate(90deg); }

/* Transisi buka/tutup dropdown lebih halus */
.collapse {
  transition: height 0.25s ease-in-out;
}

/* Warna dan gaya link aktif */
.nav-link.active {
  font-weight: 600;
  color: #0d6efd !important;
  text-decoration: underline;
}
.sub-menu .nav-link {
  padding-left: 2.2rem;
}

/* Judul kategori */
.sidebar-category p {
  text-transform: uppercase;
  font-weight: 600;
  letter-spacing: 0.5px;
  color: #9da5b1;
}
</style>

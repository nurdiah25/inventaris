@php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

$role = strtolower(Auth::user()->role ?? '');
$cabang = strtolower(Auth::user()->cabang ?? '');
$currentPrefix = explode('.', Route::currentRouteName())[0] ?? '';
@endphp

<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    {{-- === HEADER === --}}
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

    {{-- === CABANG HEADER === --}}
    <li class="nav-item sidebar-category">
      <p>Cabang</p>
      <span></span>
    </li>

    {{-- ===================================================== --}}
    {{-- ================ SUPERADMIN VIEW ==================== --}}
    {{-- ===================================================== --}}
    @if($role === 'superadmin')
      {{-- === BANJARBARU === --}}
      @php $banjarActive = $currentPrefix === 'banjarbaru'; @endphp
      <li class="nav-item">
        <a class="nav-link sidebar-toggle {{ $banjarActive ? '' : 'collapsed' }}"
           data-bs-toggle="collapse"
           href="#menu-banjarbaru"
           role="button"
           aria-expanded="{{ $banjarActive ? 'true' : 'false' }}">
          <i class="mdi mdi-store menu-icon"></i>
          <span class="menu-title">Banjarbaru</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ $banjarActive ? 'show' : '' }}" id="menu-banjarbaru">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="{{ route('banjarbaru.barang') }}">Data Barang</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('banjarbaru.stok') }}">Stok</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('banjarbaru.riwayat') }}">Riwayat Pengiriman</a></li>
          </ul>
        </div>
      </li>

      {{-- === MARTAPURA === --}}
      @php $martapuraActive = $currentPrefix === 'martapura'; @endphp
      <li class="nav-item">
        <a class="nav-link sidebar-toggle {{ $martapuraActive ? '' : 'collapsed' }}"
           data-bs-toggle="collapse"
           href="#menu-martapura"
           role="button"
           aria-expanded="{{ $martapuraActive ? 'true' : 'false' }}">
          <i class="mdi mdi-factory menu-icon"></i>
          <span class="menu-title">Martapura</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ $martapuraActive ? 'show' : '' }}" id="menu-martapura">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="{{ route('martapura.barang') }}">Data Barang</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('martapura.stok') }}">Stok</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('martapura.riwayat') }}">Riwayat Pengiriman</a></li>
          </ul>
        </div>
      </li>

      {{-- === LIANG ANGGANG === --}}
      @php $liangActive = $currentPrefix === 'lianganggang'; @endphp
      <li class="nav-item">
        <a class="nav-link sidebar-toggle {{ $liangActive ? '' : 'collapsed' }}"
           data-bs-toggle="collapse"
           href="#menu-liang"
           role="button"
           aria-expanded="{{ $liangActive ? 'true' : 'false' }}">
          <i class="mdi mdi-store menu-icon"></i>
          <span class="menu-title">Liang Anggang</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ $liangActive ? 'show' : '' }}" id="menu-liang">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="{{ route('lianganggang.barang') }}">Data Barang</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('lianganggang.stok') }}">Stok</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('lianganggang.riwayat') }}">Riwayat Pengiriman</a></li>
          </ul>
        </div>
      </li>

      {{-- === GUDANG PUSAT === --}}
      @php $gudangActive = $currentPrefix === 'gudangpusat'; @endphp
      <li class="nav-item sidebar-category">
        <p>Gudang Utama</p>
        <span></span>
      </li>
      <li class="nav-item">
        <a class="nav-link sidebar-toggle {{ $gudangActive ? '' : 'collapsed' }}"
           data-bs-toggle="collapse"
           href="#menu-gudangpusat"
           role="button"
           aria-expanded="{{ $gudangActive ? 'true' : 'false' }}">
          <i class="mdi mdi-warehouse menu-icon"></i>
          <span class="menu-title">Gudang Pusat</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ $gudangActive ? 'show' : '' }}" id="menu-gudangpusat">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="{{ route('gudangpusat.barang') }}">Data Barang</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('gudangpusat.stok') }}">Stok</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('gudangpusat.pengiriman') }}">Pengiriman</a></li>
          </ul>
        </div>
      </li>
    @endif

    {{-- ===================================================== --}}
    {{-- ============== ADMIN CABANG MODE ==================== --}}
    {{-- ===================================================== --}}
    @if($role === 'admin_cabang')
      <li class="nav-item sidebar-category">
        <p>Cabang {{ ucfirst($cabang) }}</p>
        <span></span>
      </li>

      @if($cabang === 'banjarbaru')
        <li class="nav-item"><a class="nav-link" href="{{ route('banjarbaru.barang') }}"><i class="mdi mdi-package-variant-closed menu-icon"></i>Data Barang</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('banjarbaru.stok') }}"><i class="mdi mdi-cube menu-icon"></i>Stok</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('banjarbaru.riwayat') }}"><i class="mdi mdi-truck-delivery menu-icon"></i>Riwayat Pengiriman</a></li>

      @elseif($cabang === 'martapura')
        <li class="nav-item"><a class="nav-link" href="{{ route('martapura.barang') }}"><i class="mdi mdi-package-variant-closed menu-icon"></i>Data Barang</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('martapura.stok') }}"><i class="mdi mdi-cube menu-icon"></i>Stok</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('martapura.riwayat') }}"><i class="mdi mdi-truck-delivery menu-icon"></i>Riwayat Pengiriman</a></li>

      @elseif($cabang === 'lianganggang')
        <li class="nav-item"><a class="nav-link" href="{{ route('lianganggang.barang') }}"><i class="mdi mdi-package-variant-closed menu-icon"></i>Data Barang</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('lianganggang.stok') }}"><i class="mdi mdi-cube menu-icon"></i>Stok</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('lianganggang.riwayat') }}"><i class="mdi mdi-truck-delivery menu-icon"></i>Riwayat Pengiriman</a></li>

      @elseif($cabang === 'gudangpusat')
        <li class="nav-item"><a class="nav-link" href="{{ route('gudangpusat.barang') }}"><i class="mdi mdi-package-variant-closed menu-icon"></i>Data Barang</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('gudangpusat.stok') }}"><i class="mdi mdi-cube menu-icon"></i>Stok</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('gudangpusat.pengiriman') }}"><i class="mdi mdi-truck-delivery menu-icon"></i>Pengiriman</a></li>
      @endif
    @endif
  </ul>
</nav>

<style>
.menu-arrow { transition: transform 0.3s ease, color 0.2s ease; display: inline-block; margin-left: auto; }
.menu-arrow.rotate { transform: rotate(90deg); }
.collapse { transition: height 0.25s ease-in-out; }
.nav-link.active { font-weight: 600; color: #0d6efd !important; text-decoration: underline; }
.sub-menu .nav-link { padding-left: 2.2rem; }
.sidebar-category p { text-transform: uppercase; font-weight: 600; letter-spacing: 0.5px; color: #9da5b1; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const sidebarToggles = document.querySelectorAll('.sidebar-toggle');
  sidebarToggles.forEach(toggle => {
    toggle.addEventListener('click', function (e) {
      e.preventDefault();
      const targetSelector = this.getAttribute('href');
      const target = document.querySelector(targetSelector);
      if (!target) return;
      const collapse = bootstrap.Collapse.getOrCreateInstance(target);
      const arrow = this.querySelector('.menu-arrow');
      if (target.classList.contains('show')) {
        collapse.hide(); arrow.classList.remove('rotate');
      } else {
        document.querySelectorAll('.collapse.show').forEach(opened => {
          bootstrap.Collapse.getOrCreateInstance(opened).hide();
          const openArrow = document.querySelector(`a[href="#${opened.id}"] .menu-arrow`);
          openArrow?.classList.remove('rotate');
        });
        collapse.show(); arrow.classList.add('rotate');
      }
    });
  });
});
</script>

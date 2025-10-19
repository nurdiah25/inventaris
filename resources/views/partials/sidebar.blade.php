@php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Cabang;

$cabangs = ($global_cabangs ?? collect())->where('slug', '!=', 'gudangpusat');
\Illuminate\Support\Facades\Artisan::call('view:clear');
\Illuminate\Support\Facades\Artisan::call('cache:clear');
\Illuminate\Support\Facades\Artisan::call('route:clear');

$user = Auth::user();
$role = strtolower($user->role ?? '');
$cabang = strtolower($user->cabang ?? '');
$currentPrefix = explode('.', Route::currentRouteName())[0] ?? '';
@endphp


<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    {{-- === HEADER UTAMA === --}}
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

    {{-- ===================================================== --}}
    {{-- ================= SUPERADMIN VIEW ================== --}}
    {{-- ===================================================== --}}
    @if($role === 'superadmin')

      {{-- === CABANG DINAMIS === --}}
      <li class="nav-item sidebar-category">
        <p>Cabang</p>
        <span></span>
      </li>

      @foreach($cabangs as $c)
        @php
          $slug = trim($c->slug ?? '');
          if ($slug === '') continue;
          $isActive = $currentPrefix === $slug;
        @endphp

        <li class="nav-item">
          <a class="nav-link sidebar-toggle {{ $isActive ? '' : 'collapsed' }}"
             data-bs-toggle="collapse"
             href="#menu-{{ $slug }}"
             role="button"
             aria-expanded="{{ $isActive ? 'true' : 'false' }}">
            <i class="mdi mdi-store menu-icon"></i>
            <span class="menu-title">{{ ucfirst($c->nama_cabang) }}</span>
            <i class="menu-arrow"></i>
          </a>

          <div class="collapse {{ $isActive ? 'show' : '' }}" id="menu-{{ $slug }}">
            <ul class="nav flex-column sub-menu">
              @if(Route::has($slug.'.barang'))
                <li class="nav-item"><a class="nav-link" href="{{ route($slug.'.barang') }}">Data Barang</a></li>
              @endif
              @if(Route::has($slug.'.stok'))
                <li class="nav-item"><a class="nav-link" href="{{ route($slug.'.stok') }}">Stok Barang</a></li>
              @endif
              @if(Route::has($slug.'.riwayat'))
                <li class="nav-item"><a class="nav-link" href="{{ route($slug.'.riwayat') }}">Riwayat Pengiriman</a></li>
              @endif
            </ul>
          </div>
        </li>
      @endforeach

      {{-- === GUDANG PUSAT === --}}
      <li class="nav-item sidebar-category mt-3">
        <p>Gudang Utama</p>
        <span></span>
      </li>
      @php $gudangActive = $currentPrefix === 'gudangpusat'; @endphp
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
            @if(Route::has('gudangpusat.barang'))
              <li class="nav-item"><a class="nav-link" href="{{ route('gudangpusat.barang') }}">Data Barang</a></li>
            @endif
            @if(Route::has('gudangpusat.stok'))
              <li class="nav-item"><a class="nav-link" href="{{ route('gudangpusat.stok') }}">Stok Barang</a></li>
            @endif
            @if(Route::has('gudangpusat.pengiriman'))
              <li class="nav-item"><a class="nav-link" href="{{ route('gudangpusat.pengiriman') }}">Pengiriman</a></li>
            @endif
          </ul>
        </div>
      </li>

      {{-- === MENU ADMIN (Hanya Superadmin) === --}}
      @if(Route::has('pengguna.index'))
      <li class="nav-item sidebar-category mt-3">
        <p>Admin</p>
        <span></span>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('pengguna.index') ? 'active' : '' }}" href="{{ route('pengguna.index') }}">
          <i class="mdi mdi-account-multiple menu-icon"></i>
          <span class="menu-title">Pengguna</span>
        </a>
      </li>
      @endif
    @endif

    {{-- ===================================================== --}}
    {{-- ================ ADMIN CABANG VIEW ================= --}}
    {{-- ===================================================== --}}
    @if($role === 'admin_cabang' && !empty($cabang))
      <li class="nav-item sidebar-category">
        <p>Cabang {{ ucfirst($cabang) }}</p>
        <span></span>
      </li>

      @if(Route::has($cabang.'.barang'))
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs($cabang.'.barang') ? 'active' : '' }}" href="{{ route($cabang.'.barang') }}">
            <i class="mdi mdi-package-variant-closed menu-icon"></i>
            <span class="menu-title">Data Barang</span>
          </a>
        </li>
      @endif

      @if(Route::has($cabang.'.stok'))
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs($cabang.'.stok') ? 'active' : '' }}" href="{{ route($cabang.'.stok') }}">
            <i class="mdi mdi-cube menu-icon"></i>
            <span class="menu-title">Stok Barang</span>
          </a>
        </li>
      @endif

      @if(Route::has($cabang.'.riwayat'))
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs($cabang.'.riwayat') ? 'active' : '' }}" href="{{ route($cabang.'.riwayat') }}">
            <i class="mdi mdi-truck-delivery menu-icon"></i>
            <span class="menu-title">Riwayat Pengiriman</span>
          </a>
        </li>
      @endif
    @endif

  </ul>
</nav>

{{-- === STYLE & SCRIPT === --}}
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

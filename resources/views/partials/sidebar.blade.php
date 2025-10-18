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
      <a class="nav-link sidebar-toggle" data-bs-toggle="collapse" href="#banjarbaru" aria-expanded="false" aria-controls="banjarbaru">
        <i class="mdi mdi-store menu-icon"></i>
        <span class="menu-title">Banjarbaru</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="banjarbaru">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('banjarbaru.barang') }}">Data Barang</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('banjarbaru.stok') }}">Stok</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('banjarbaru.riwayat') }}">Riwayat Pengiriman</a></li>
        </ul>
      </div>
    </li>

    {{-- CABANG MARTAPURA --}}
    <li class="nav-item">
      <a class="nav-link sidebar-toggle" data-bs-toggle="collapse" href="#martapura" aria-expanded="false" aria-controls="martapura">
        <i class="mdi mdi-factory menu-icon"></i>
        <span class="menu-title">Martapura</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="martapura">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('martapura.barang') }}">Data Barang</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('martapura.stok') }}">Stok</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('martapura.riwayat') }}">Riwayat Pengiriman</a></li>
        </ul>
      </div>
    </li>

    {{-- CABANG LIANG ANGGANG --}}
    <li class="nav-item">
      <a class="nav-link sidebar-toggle" data-bs-toggle="collapse" href="#lianganggang" aria-expanded="false" aria-controls="lianganggang">
        <i class="mdi mdi-store menu-icon"></i>
        <span class="menu-title">Liang Anggang</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="lianganggang">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('lianganggang.barang') }}">Data Barang</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('lianganggang.stok') }}">Stok</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('lianganggang.riwayat') }}">Riwayat Pengiriman</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item sidebar-category">
      <p>Gudang Utama</p>
      <span></span>
    </li>

  {{-- GUDANG PUSAT --}}
<li class="nav-item">
  <a class="nav-link sidebar-toggle" data-bs-toggle="collapse" href="#gudangpusat" aria-expanded="false" aria-controls="gudangpusat">
    <i class="mdi mdi-warehouse menu-icon"></i>
    <span class="menu-title">Gudang Pusat</span>
    <i class="menu-arrow"></i>
  </a>
  <div class="collapse" id="gudangpusat">
    <ul class="nav flex-column sub-menu">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('gudangpusat.barang') }}">Data Barang</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('gudangpusat.stok') }}">Stok</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('gudangpusat.pengiriman') }}">Pengiriman</a>
      </li>
    </ul>
  </div>
</li>

  </ul>
</nav>

{{-- === Script agar klik 1x buka, klik lagi tutup === --}}
<script>
document.querySelectorAll('.sidebar-toggle').forEach(link => {
  link.addEventListener('click', function (e) {
    e.preventDefault();

    const targetId = this.getAttribute('href');
    const target = document.querySelector(targetId);
    const bsCollapse = bootstrap.Collapse.getInstance(target) || new bootstrap.Collapse(target, { toggle: false });

    // Toggle dropdown buka/tutup
    if (target.classList.contains('show')) {
      bsCollapse.hide();
      this.classList.remove('active');
    } else {
      bsCollapse.show();
      this.classList.add('active');
    }

    // Putar panah menu-arrow
    const arrow = this.querySelector('.menu-arrow');
    if (arrow) {
      arrow.classList.toggle('rotate');
    }
  });
});

// CSS tambahan biar panah berputar halus
const style = document.createElement('style');
style.innerHTML = `
  .menu-arrow {
    transition: transform 0.3s ease;
  }
  .menu-arrow.rotate {
    transform: rotate(90deg);
  }
`;
document.head.appendChild(style);
</script>
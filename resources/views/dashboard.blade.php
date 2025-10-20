@extends('layouts.app')

@section('content')
<div class="container-fluid" id="dashboardContainer" style="background-color: #f2f4f8; min-height: 100vh; padding: 0;">

  <!-- Judul Dashboard -->
  <div class="row">
    <div class="col-md-12 bg-white py-3 px-4">
      <h3 class="font-weight-bold mb-0">Dashboard</h3>
    </div>
  </div>

  <style>
    /* 🌟 Styling Dashboard Cards */
    .dashboard-card {
      background-color: #ffffff;
      border-radius: 16px;
      box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
      border: none;
      transition: all 0.2s ease-in-out;
      padding: 25px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .dashboard-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    .dashboard-icon {
      width: 65px;
      height: 65px;
      border-radius: 50%;
      background: #e9f2ff;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 15px auto;
      color: #084fbaff;
      font-size: 2rem;
    }

    .dashboard-card h5 {
      font-size: 1.4rem;
      font-weight: 600;
      color: #333;
    }

    .metric-box {
      background-color: #f1f6ff;
      border-radius: 10px;
      padding: 15px;
      transition: 0.3s ease;
    }

    .metric-box:hover {
      background-color: #e0ecff;
    }

    .metric-box h6 {
      color: #555;
      font-size: 0.95rem;
      font-weight: 500;
    }

    .metric-box p {
      font-size: 1.6rem;
      font-weight: 600;
      color: #084fbaff;
      margin: 10px 0 0 0;
    }
  </style>

  {{-- ================= SUPERADMIN ================= --}}
  @if(Auth::user()->role === 'superadmin')
  <div class="row mt-4 px-3">

    <!-- 🏢 Gudang Pusat -->
    <div class="col-md-6 mb-4">
      <div class="dashboard-card">
        <div class="dashboard-icon">
          <i class="mdi mdi-home-modern"></i>
        </div>
        <h5>Gudang Pusat</h5>
        <div class="row mt-4">
          <div class="col-6">
            <div class="metric-box">
              <h6>Jumlah Jenis Barang</h6>
              <p>{{ $jumlahGudangPusat ?? 0 }}</p>
            </div>
          </div>
          <div class="col-6">
            <div class="metric-box">
              <h6>Jumlah Barang Keseluruhan</h6>
              <p>{{ $totalGudangPusat ?? 0 }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- 🏬 Semua Cabang Dinamis -->
    @php
      // Daftar ikon otomatis (diulang sesuai urutan cabang)
      $availableIcons = [
        'mdi-store', 
        'mdi-office-building', 
        'mdi-factory', 
        'mdi-domain', 
        'mdi-city', 
        'mdi-storefront-outline',
        'mdi-domain-plus'
      ];
      $index = 0;
    @endphp

    @foreach($cabangs as $cabang)
    @php
      $slug = strtolower($cabang->nama_cabang);
      $data = $dataCabang[$slug] ?? ['jumlahJenis' => 0, 'totalStok' => 0];
      $icon = $availableIcons[$index % count($availableIcons)];
      $index++;
    @endphp

    <div class="col-md-6 mb-4">
      <div class="dashboard-card">
        <div class="dashboard-icon">
          <i class="mdi {{ $icon }}"></i>
        </div>
        <h5>Cabang {{ ucfirst($cabang->nama_cabang) }}</h5>
        <div class="row mt-4">
          <div class="col-6">
            <div class="metric-box">
              <h6>Jumlah Jenis Barang</h6>
              <p>{{ $data['jumlahJenis'] ?? 0 }}</p>
            </div>
          </div>
          <div class="col-6">
            <div class="metric-box">
              <h6>Jumlah Barang Keseluruhan</h6>
              <p>{{ $data['totalStok'] ?? 0 }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach

  </div>

  {{-- ================= ADMIN CABANG ================= --}}
  @else
  @php
    $slug = strtolower(Auth::user()->cabang ?? '');
    $data = $dataCabang[$slug] ?? ['jumlahJenis' => $jumlahJenis ?? 0, 'totalStok' => $totalStok ?? 0];
  @endphp

  <div class="row mt-5 px-3">
    <div class="col-md-8 mx-auto">
      <div class="dashboard-card">
        <div class="dashboard-icon">
          <i class="mdi mdi-store"></i>
        </div>
        <h5>Dashboard Cabang {{ ucfirst($slug) }}</h5>
        <div class="row mt-4">
          <div class="col-6">
            <div class="metric-box">
              <h6>Jumlah Jenis Barang</h6>
              <p>{{ $data['jumlahJenis'] ?? 0 }}</p>
            </div>
          </div>
          <div class="col-6">
            <div class="metric-box">
              <h6>Jumlah Barang Keseluruhan</h6>
              <p>{{ $data['totalStok'] ?? 0 }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

</div>
@endsection

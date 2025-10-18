@extends('layouts.app')

@section('content')
<div class="page-header">
  <h3 class="page-title">Riwayat Pengiriman ke Cabang {{ ucfirst($cabangData->nama_cabang) }}</h3>
</div>

<div class="card">
  <div class="card-body">
    @if($riwayat->isEmpty())
      <p>Tidak ada data pengiriman dari Gudang Pusat.</p>
    @else
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Tanggal Pengiriman</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach($riwayat as $r)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $r->barang->nama_barang }}</td>
            <td>{{ $r->jumlah }}</td>
            <td>{{ \Carbon\Carbon::parse($r->tanggal_pengiriman)->format('d M Y') }}</td>
            <td>{{ $r->status_pengiriman }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @endif
  </div>
</div>
@endsection

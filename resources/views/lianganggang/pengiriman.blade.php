@extends('layouts.app')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <h3 class="page-title">Data Pengiriman - Cabang {{ ucfirst($cabangData->nama_cabang) }}</h3>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPengiriman">
        <i class="bi bi-plus-circle"></i> Tambah Pengiriman
    </button>
</div>

@if(session('success'))
<div class="alert alert-success mt-2">{{ session('success') }}</div>
@endif

<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">Daftar Pengiriman</h4>
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Tujuan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengiriman as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->barang->nama_barang }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ $item->tujuan_pengiriman }}</td>
                        <td>{{ $item->tanggal_pengiriman }}</td>
                        <td>
                            <form action="{{ route($cabangData->nama_cabang . '.pengiriman.updateStatus', $item->id_pengiriman) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status_pengiriman" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="Dikemas" {{ $item->status_pengiriman == 'Dikemas' ? 'selected' : '' }}>Dikemas</option>
                                    <option value="Dikirim" {{ $item->status_pengiriman == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                                    <option value="Terkirim" {{ $item->status_pengiriman == 'Terkirim' ? 'selected' : '' }}>Terkirim</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route($cabangData->nama_cabang . '.pengiriman.destroy', $item->id_pengiriman) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data pengiriman ini?')" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada pengiriman</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Pengiriman -->
<div class="modal fade" id="modalTambahPengiriman" tabindex="-1" aria-labelledby="modalTambahPengirimanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route($cabangData->nama_cabang . '.pengiriman.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahPengirimanLabel">Tambah Pengiriman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- Pilih Barang -->
                    <div class="mb-3">
                        <label for="id_barang" class="form-label">Nama Barang</label>
                        <select name="id_barang" class="form-control" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach($barangs as $barang)
                                <option value="{{ $barang->id_barang }}">{{ $barang->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jumlah -->
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" min="1" required>
                    </div>

                    <!-- Tujuan Pengiriman -->
                    <div class="mb-3">
                        <label for="tujuan_pengiriman" class="form-label">Tujuan Pengiriman</label>
                        <select name="tujuan_pengiriman" class="form-control" required>
                            <option value="">-- Pilih Tujuan Pengiriman --</option>
                            @foreach($cabangs as $cabang)
                                @if($cabang->id_cabang != $cabangData->id_cabang)
                                    <option value="{{ $cabang->nama_cabang }}">{{ ucfirst($cabang->nama_cabang) }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!-- Tanggal -->
                    <div class="mb-3">
                        <label for="tanggal_pengiriman" class="form-label">Tanggal Pengiriman</label>
                        <input type="date" name="tanggal_pengiriman" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

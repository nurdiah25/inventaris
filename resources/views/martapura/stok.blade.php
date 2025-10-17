@extends('layouts.app')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <h3 class="page-title">Data Stok - Cabang {{ ucfirst($cabangData->nama_cabang) }}</h3>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahStok">
        <i class="bi bi-plus-circle"></i> Tambah Stok
    </button>
</div>

@if(session('success'))
<div class="alert alert-success mt-2">{{ session('success') }}</div>
@endif

<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">Daftar Stok Barang</h4>
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Masuk</th>
                        <th>Keluar</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($stoks as $index => $stok)
                    @php
                        $stokBarang = $stok->barang ? $stok->barang->stok : 0;
                        $status = $stokBarang >= 10 ? 'Masih Banyak' : 'Menipis';
                        $badgeClass = $stokBarang >= 10 ? 'bg-success' : 'bg-warning';
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $stok->barang->nama_barang ?? '-' }}</td>
                        <td>{{ $stok->jumlah_masuk }}</td>
                        <td>{{ $stok->jumlah_keluar }}</td>
                        <td>{{ $stok->tanggal }}</td>
                        <td><span class="badge {{ $badgeClass }}">{{ $status }}</span></td>
                        <td>
                            <!-- Tombol Edit -->
                            <button 
                                class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditStok{{ $stok->id_stok }}">
                                Edit
                            </button>

                            <!-- Tombol Hapus -->
                            <form action="{{ route($cabangData->nama_cabang . '.stok.destroy', $stok->id_stok) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit Stok -->
                    <div class="modal fade" id="modalEditStok{{ $stok->id_stok }}" tabindex="-1" aria-labelledby="modalEditStokLabel{{ $stok->id_stok }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route($cabangData->nama_cabang . '.stok.update', $stok->id_stok) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditStokLabel{{ $stok->id_stok }}">Edit Stok</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Barang</label>
                                            <select name="id_barang" class="form-control" required>
                                                @foreach ($barangs as $barang)
                                                    <option value="{{ $barang->id_barang }}" {{ $barang->id_barang == $stok->id_barang ? 'selected' : '' }}>
                                                        {{ $barang->nama_barang }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Jumlah Masuk</label>
                                            <input type="number" name="jumlah_masuk" class="form-control" value="{{ $stok->jumlah_masuk }}" min="0">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Jumlah Keluar</label>
                                            <input type="number" name="jumlah_keluar" class="form-control" value="{{ $stok->jumlah_keluar }}" min="0">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Tanggal</label>
                                            <input type="date" name="tanggal" class="form-control" value="{{ $stok->tanggal }}" required>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada data stok</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Stok -->
<div class="modal fade" id="modalTambahStok" tabindex="-1" aria-labelledby="modalTambahStokLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route($cabangData->nama_cabang . '.stok.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahStokLabel">Tambah Stok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id_barang" class="form-label">Nama Barang</label>
                        <select name="id_barang" class="form-control" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->id_barang }}">{{ $barang->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_masuk" class="form-label">Jumlah Masuk</label>
                        <input type="number" name="jumlah_masuk" class="form-control" value="0">
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_keluar" class="form-label">Jumlah Keluar</label>
                        <input type="number" name="jumlah_keluar" class="form-control" value="0">
                    </div>

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
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

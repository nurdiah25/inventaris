@extends('layouts.app')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <h3 class="page-title">Manajemen Pengguna (Admin Cabang)</h3>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPengguna">
        <i class="bi bi-plus-circle"></i> Tambah Pengguna
    </button>
</div>

@if(session('success'))
    <div class="alert alert-success mt-2">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger mt-2">{{ session('error') }}</div>
@endif

<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">Daftar Pengguna</h4>
        <div class="table-responsive">
            <table class="table table-striped text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Cabang</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $u)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ ucfirst($u->cabang ?? '-') }}</td>
                            <td><span class="badge bg-info text-dark">{{ $u->role }}</span></td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $u->id }}">
                                    Edit
                                </button>

                                <form action="{{ route('pengguna.destroy', $u->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus pengguna ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit Pengguna -->
                        <div class="modal fade" id="modalEdit{{ $u->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $u->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('pengguna.update', $u->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalEditLabel{{ $u->id }}">Edit Pengguna</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label>Nama</label>
                                                <input type="text" name="name" value="{{ $u->name }}" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Email</label>
                                                <input type="email" name="email" value="{{ $u->email }}" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Cabang</label>
                                                <select name="cabang" class="form-control" required>
                                                    <option value="banjarbaru" {{ $u->cabang == 'banjarbaru' ? 'selected' : '' }}>Banjarbaru</option>
                                                    <option value="martapura" {{ $u->cabang == 'martapura' ? 'selected' : '' }}>Martapura</option>
                                                    <option value="lianganggang" {{ $u->cabang == 'lianganggang' ? 'selected' : '' }}>Liang Anggang</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label>Password (opsional)</label>
                                                <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
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
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada pengguna.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Pengguna -->
<div class="modal fade" id="modalTambahPengguna" tabindex="-1" aria-labelledby="modalTambahPenggunaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('pengguna.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahPenggunaLabel">Tambah Pengguna Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="cabang" class="form-label">Nama Cabang Baru</label>
            <input type="text" name="cabang" class="form-control" placeholder="Misal: Banjarmasin" required>
            <small class="text-muted">Jika nama cabang belum ada, sistem akan membuat cabang baru otomatis.</small>
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

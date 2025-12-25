@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Data Ruangan</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('admin.rooms.create') }}" class="btn btn-sm btn-primary">Tambah Ruangan</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('admin.rooms.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" name="search" class="form-control" placeholder="Cari ruangan..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-3">
                                <select name="category_id" class="form-control">
                                    <option value="">Semua Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="status" class="form-control">
                                    <option value="">Semua Status</option>
                                    <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                    <option value="tidak_tersedia" {{ request('status') == 'tidak_tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                                    <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Nama Ruangan</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Kapasitas</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rooms as $room)
                                <tr>
                                    <td>{{ ($rooms->currentPage() - 1) * $rooms->perPage() + $loop->iteration }}</td>
                                    <td>
                                        @if($room->foto)
                                            <img src="{{ asset('storage/' . $room->foto) }}" alt="{{ $room->nama_ruangan }}" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $room->nama_ruangan }}</td>
                                    <td>{{ $room->jumlah_ruangan ?? 1 }}</td>
                                    <td>{{ $room->category->nama_kategori }}</td>
                                    <td>{{ $room->kapasitas }} orang</td>
                                    <td>
                                        @if($room->status == 'tersedia')
                                            <span class="badge badge-success">Tersedia</span>
                                        @elseif($room->status == 'tidak_tersedia')
                                            <span class="badge badge-danger">Tidak Tersedia</span>
                                        @else
                                            <span class="badge badge-warning">Maintenance</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.rooms.show', $room) }}" class="btn btn-sm btn-info">Detail</a>
                                        <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        {{ $rooms->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


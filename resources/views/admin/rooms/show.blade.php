@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3 class="mb-0">Detail Ruangan: {{ $room->nama_ruangan }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if($room->foto)
                                <img src="{{ asset('storage/' . $room->foto) }}" alt="{{ $room->nama_ruangan }}" class="img-fluid">
                            @else
                                <p class="text-muted">Tidak ada foto</p>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <dl class="row">
                                <dt class="col-sm-4">Nama Ruangan</dt>
                                <dd class="col-sm-8">{{ $room->nama_ruangan }}</dd>
                                <dt class="col-sm-4">Kategori</dt>
                                <dd class="col-sm-8">{{ $room->category->nama_kategori }}</dd>
                                <dt class="col-sm-4">Kapasitas</dt>
                                <dd class="col-sm-8">{{ $room->kapasitas }} orang</dd>
                                <dt class="col-sm-4">Status</dt>
                                <dd class="col-sm-8">
                                    @if($room->status == 'tersedia')
                                        <span class="badge badge-success">Tersedia</span>
                                    @elseif($room->status == 'tidak_tersedia')
                                        <span class="badge badge-danger">Tidak Tersedia</span>
                                    @else
                                        <span class="badge badge-warning">Maintenance</span>
                                    @endif
                                </dd>
                                <dt class="col-sm-4">Deskripsi</dt>
                                <dd class="col-sm-8">{{ $room->deskripsi ?? '-' }}</dd>
                                <dt class="col-sm-4">Fasilitas</dt>
                                <dd class="col-sm-8">{{ $room->fasilitas ?? '-' }}</dd>
                            </dl>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Kembali</a>
                        <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


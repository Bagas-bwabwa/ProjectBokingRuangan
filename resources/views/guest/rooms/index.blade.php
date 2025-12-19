@extends('layouts.guest')

@section('content')
<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Daftar Ruangan Tersedia</h3>
                    </div>
                    @auth
                    <div class="col-auto">
                        <a href="{{ route('guest.dashboard') }}" class="btn btn-sm btn-primary">Dashboard Saya</a>
                    </div>
                    @endauth
                </div>
            </div>
            <div class="card-body">
                    <!-- Search & Filter Form -->
                    <form method="GET" action="{{ route('guest.rooms.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
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
                                <input type="number" name="kapasitas" class="form-control" placeholder="Min. Kapasitas" value="{{ request('kapasitas') }}" min="1">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-block">Cari</button>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        @forelse($rooms as $room)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                @if($room->foto)
                                    <img src="{{ asset('storage/' . $room->foto) }}" class="card-img-top" alt="{{ $room->nama_ruangan }}" style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $room->nama_ruangan }}</h5>
                                    <p class="card-text">
                                        <small class="text-muted">{{ $room->category->nama_kategori }}</small><br>
                                        <i class="ni ni-single-02"></i> Kapasitas: {{ $room->kapasitas }} orang<br>
                                        @if($room->deskripsi)
                                            {{ Str::limit($room->deskripsi, 100) }}
                                        @endif
                                    </p>
                                    <a href="{{ route('guest.rooms.show', $room) }}" class="btn btn-primary">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="alert alert-info">
                                Tidak ada ruangan yang tersedia.
                            </div>
                        </div>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        {{ $rooms->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


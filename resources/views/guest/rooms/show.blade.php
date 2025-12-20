@extends('layouts.guest')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    @if($room->foto)
                        <img src="{{ asset('storage/' . $room->foto) }}" class="img-fluid mb-3" alt="{{ $room->nama_ruangan }}">
                    @endif
                    <h2>{{ $room->nama_ruangan }}</h2>
                    <p class="text-muted">{{ $room->category->nama_kategori }}</p>
                    <hr>
                    <dl class="row">
                        <dt class="col-sm-3">Kapasitas</dt>
                        <dd class="col-sm-9">{{ $room->kapasitas }} orang</dd>
                        <dt class="col-sm-3">Deskripsi</dt>
                        <dd class="col-sm-9">{{ $room->deskripsi ?? '-' }}</dd>
                        <dt class="col-sm-3">Fasilitas</dt>
                        <dd class="col-sm-9">{{ $room->fasilitas ?? '-' }}</dd>
                    </dl>
                    @auth
                        <a href="{{ route('guest.rooms.booking', $room) }}" class="btn btn-primary">Booking Ruangan</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Login untuk Booking</a>
                    @endauth
                </div>
            </div>

            @if($upcomingBookings->count() > 0)
            <div class="card shadow mt-4">
                <div class="card-header">
                    <h3 class="mb-0">Jadwal Terjadwal</h3>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach($upcomingBookings as $booking)
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $booking->tanggal->format('d/m/Y') }}</h5>
                                <small>{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</small>
                            </div>
                            <p class="mb-1">{{ $booking->keperluan ?? '-' }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="mb-0">Informasi</h3>
                </div>
                <div class="card-body">
                    <p><strong>Status:</strong> 
                        @if($room->status == 'tersedia')
                            <span class="badge badge-success">Tersedia</span>
                        @else
                            <span class="badge badge-danger">Tidak Tersedia</span>
                        @endif
                    </p>
                    <a href="{{ route('guest.rooms.index') }}" class="btn btn-secondary btn-block">Kembali ke Daftar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


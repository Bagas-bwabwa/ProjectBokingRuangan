@extends('layouts.staff')

@section('content')
<!-- Header -->
<div class="row mb-4">
    <div class="col-md-12">
        <h3 class="mb-0">Dashboard Staff - Booking Pending</h3>
    </div>
</div>

<!-- Quick Stats Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted mb-2">Total Pending</h6>
                <h3 class="text-warning mb-0">{{ $pendingBookings->total() }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted mb-2">Halaman Aktual</h6>
                <h3 class="text-primary mb-0">{{ $pendingBookings->currentPage() }} / {{ $pendingBookings->lastPage() }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <a href="{{ route('staff.bookings.index') }}" class="card shadow-sm text-decoration-none text-dark">
            <div class="card-body">
                <h6 class="text-muted mb-2">Lihat Semua</h6>
                <h3 class="text-secondary mb-0">Booking</h3>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted mb-2">Akses Laporan</h6>
                <h3 class="text-info mb-0">Lengkap</h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h5 class="mb-0">Daftar Booking Pending</h5>
                </div>
                <div class="card-body">
                    @if($pendingBookings->count() > 0)
                        <div class="row">
                            @foreach($pendingBookings as $booking)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $booking->room->nama_ruangan }}</h5>
                                        <p class="card-text">
                                            <strong>Pemesan:</strong> {{ $booking->user->name }}<br>
                                            <strong>Tanggal:</strong> {{ $booking->tanggal->format('d/m/Y') }}<br>
                                            <strong>Jam:</strong> {{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}<br>
                                            <strong>Keperluan:</strong> {{ $booking->keperluan ?? '-' }}
                                        </p>
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('staff.bookings.show', $booking) }}" class="btn btn-sm btn-info">Detail</a>
                                            <form action="{{ route('staff.bookings.approve', $booking) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                            </form>
                                            <form action="{{ route('staff.bookings.reject', $booking) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menolak?');">Reject</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-5">
                            {{ $pendingBookings->links('pagination::bootstrap-4') }}
                        </div>
                    @else
                        <div class="alert alert-info">
                            Tidak ada booking pending saat ini.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


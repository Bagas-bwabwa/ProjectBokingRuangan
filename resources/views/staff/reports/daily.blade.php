@extends('layouts.staff')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h3 class="mb-0">Laporan Booking Harian</h3>
    </div>
    <div class="col-md-4">
        <form method="GET" class="d-flex gap-2">
            <input type="date" name="date" class="form-control" value="{{ $date }}" required>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total Booking</h6>
                <h3 class="text-primary">{{ $statistics['total_bookings'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Pending</h6>
                <h3 class="text-warning">{{ $statistics['pending'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Approved</h6>
                <h3 class="text-success">{{ $statistics['approved'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Rejected</h6>
                <h3 class="text-danger">{{ $statistics['rejected'] }}</h3>
            </div>
        </div>
    </div>
</div>

<!-- Bookings Table -->
<div class="card shadow">
    <div class="card-header border-0">
        <h5 class="mb-0">Daftar Booking - {{ \Carbon\Carbon::parse($date)->format('d F Y') }}</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-sm mb-0">
            <thead class="thead-light">
                <tr>
                    <th>Waktu</th>
                    <th>Ruangan</th>
                    <th>Pemesan</th>
                    <th>Keperluan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                <tr>
                    <td>
                        <small>{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</small>
                    </td>
                    <td>
                        <strong>{{ $booking->room->nama_ruangan }}</strong>
                    </td>
                    <td>
                        {{ $booking->user->name }}<br>
                        <small class="text-muted">{{ $booking->user->email }}</small>
                    </td>
                    <td>{{ $booking->keperluan ?? '-' }}</td>
                    <td>
                        @if($booking->status === 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif($booking->status === 'approved')
                            <span class="badge badge-success">Approved</span>
                        @elseif($booking->status === 'rejected')
                            <span class="badge badge-danger">Rejected</span>
                        @elseif($booking->status === 'completed')
                            <span class="badge badge-secondary">Completed</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('staff.bookings.show', $booking) }}" class="btn btn-sm btn-info">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4">
                        <div class="alert alert-info mb-0">Tidak ada booking pada tanggal ini.</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Navigation Links -->
<div class="mt-4 text-center">
    <a href="{{ route('staff.reports.statistics') }}" class="btn btn-secondary">Kembali ke Statistik</a>
</div>
@endsection

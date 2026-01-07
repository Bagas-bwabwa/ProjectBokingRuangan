@extends('layouts.staff')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h3 class="mb-0">Laporan Booking Bulanan</h3>
    </div>
    <div class="col-md-4">
        <form method="GET" class="d-flex gap-2">
            <select name="month" class="form-control" required>
                @for($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::createFromDate(null, $m, 1)->format('F') }}
                    </option>
                @endfor
            </select>
            <select name="year" class="form-control" required>
                @for($y = now()->year - 5; $y <= now()->year; $y++)
                    <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
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
                <h3 class="text-primary">{{ array_sum($statusStats) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Pending</h6>
                <h3 class="text-warning">{{ $statusStats['pending'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Approved</h6>
                <h3 class="text-success">{{ $statusStats['approved'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Rejected</h6>
                <h3 class="text-danger">{{ $statusStats['rejected'] }}</h3>
            </div>
        </div>
    </div>
</div>

<!-- Room Statistics -->
<div class="card shadow mb-4">
    <div class="card-header border-0">
        <h5 class="mb-0">Statistik Penggunaan Ruangan - {{ $monthName }}</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-sm mb-0">
            <thead class="thead-light">
                <tr>
                    <th>Ruangan</th>
                    <th>Total Booking</th>
                    <th>Approved</th>
                    <th>Persentase</th>
                </tr>
            </thead>
            <tbody>
                @forelse($roomStats as $room)
                <tr>
                    <td><strong>{{ $room['room_name'] }}</strong></td>
                    <td>{{ $room['total'] }}</td>
                    <td>{{ $room['approved'] }}</td>
                    <td>
                        @if($room['total'] > 0)
                            @php $percent = ($room['approved'] / $room['total']) * 100; @endphp
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {!! $percent !!}%;">
                                    {{ round($percent, 2) }}%
                                </div>
                            </div>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4">
                        <div class="alert alert-info mb-0">Tidak ada data booking untuk periode ini.</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Detailed Bookings List -->
<div class="card shadow">
    <div class="card-header border-0">
        <h5 class="mb-0">Daftar Booking Detail</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-sm mb-0">
            <thead class="thead-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Ruangan</th>
                    <th>Pemesan</th>
                    <th>Waktu</th>
                    <th>Keperluan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                <tr>
                    <td>{{ $booking->tanggal->format('d/m/Y') }}</td>
                    <td>{{ $booking->room->nama_ruangan }}</td>
                    <td>
                        {{ $booking->user->name }}<br>
                        <small class="text-muted">{{ $booking->user->email }}</small>
                    </td>
                    <td><small>{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</small></td>
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
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4">
                        <div class="alert alert-info mb-0">Tidak ada booking untuk periode ini.</div>
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

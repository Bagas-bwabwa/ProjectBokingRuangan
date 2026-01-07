@extends('layouts.staff')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h2 class="mb-0">Dashboard Laporan & Statistik</h2>
        <p class="text-muted">Ringkasan data booking dan analisis yang relevan dengan tugas staff</p>
    </div>
</div>

<!-- Daily Statistics -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card shadow">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="text-muted mb-3">Booking Hari Ini</h6>
                        <h3 class="text-primary mb-0">{{ $dailyStats['bookings_today'] }}</h3>
                    </div>
                    <div class="ms-auto">
                        <i class="fas fa-calendar fa-3x  text-muted opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="text-muted mb-3">Pending Hari Ini</h6>
                        <h3 class="text-warning mb-0">{{ $dailyStats['pending_today'] }}</h3>
                    </div>
                    <div class="ms-auto">
                        <i class="fas fa-hourglass fa-3x text-muted opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="text-muted mb-3">Approved Hari Ini</h6>
                        <h3 class="text-success mb-0">{{ $dailyStats['approved_today'] }}</h3>
                    </div>
                    <div class="ms-auto">
                        <i class="fas fa-check-circle fa-3x text-muted opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="text-muted mb-3">Approval Rate</h6>
                        <h3 class="text-info mb-0">{{ $overallStats['approval_rate'] }}%</h3>
                    </div>
                    <div class="ms-auto">
                        <i class="fas fa-chart-pie fa-3x text-muted opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Monthly Statistics -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Booking Bulan Ini</h6>
                <h3 class="text-primary">{{ $monthlyStats['total_bookings'] }}</h3>
                <small class="text-muted">Total semua booking</small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Pending Bulan Ini</h6>
                <h3 class="text-warning">{{ $monthlyStats['pending'] }}</h3>
                <small class="text-muted">Menunggu persetujuan</small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Approved Bulan Ini</h6>
                <h3 class="text-success">{{ $monthlyStats['approved'] }}</h3>
                <small class="text-muted">Sudah disetujui</small>
            </div>
        </div>
    </div>
</div>

<!-- Overall Statistics and Actions -->
<div class="row mb-4">
    <!-- Left Column: Overall Stats -->
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header border-0">
                <h5 class="mb-0">Statistik Keseluruhan</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total Booking</span>
                        <strong>{{ $overallStats['total_bookings'] }}</strong>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Approved</span>
                        <strong class="text-success">{{ $overallStats['total_approved'] }}</strong>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Rejected</span>
                        <strong class="text-danger">{{ $overallStats['total_rejected'] }}</strong>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Completed</span>
                        <strong class="text-info">{{ $overallStats['total_completed'] }}</strong>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span>Approval Rate</span>
                    <strong class="text-primary">{{ $overallStats['approval_rate'] }}%</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Quick Actions -->
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header border-0">
                <h5 class="mb-0">Menu Laporan</h5>
            </div>
            <div class="card-body">
                <div class="btn-group-vertical w-100" role="group">
                    <a href="{{ route('staff.reports.daily') }}" class="btn btn-outline-primary btn-sm text-start py-3 border-bottom">
                        <i class="fas fa-calendar-day"></i> Laporan Booking Harian
                        <small class="d-block text-muted">Lihat data booking per hari</small>
                    </a>
                    <a href="{{ route('staff.reports.monthly') }}" class="btn btn-outline-primary btn-sm text-start py-3 border-bottom">
                        <i class="fas fa-calendar-alt"></i> Laporan Booking Bulanan
                        <small class="d-block text-muted">Analisis booking per bulan</small>
                    </a>
                    <a href="{{ route('staff.reports.occupancy') }}" class="btn btn-outline-primary btn-sm text-start py-3 border-bottom">
                        <i class="fas fa-door-open"></i> Laporan Penggunaan Ruangan
                        <small class="d-block text-muted">Occupancy rate per ruangan</small>
                    </a>
                    <a href="{{ route('staff.reports.approval') }}" class="btn btn-outline-primary btn-sm text-start py-3 border-bottom">
                        <i class="fas fa-chart-line"></i> Laporan Tingkat Persetujuan
                        <small class="d-block text-muted">Approval dan rejection rate</small>
                    </a>
                    <a href="{{ route('staff.reports.top-users') }}" class="btn btn-outline-primary btn-sm text-start py-3">
                        <i class="fas fa-users"></i> Laporan Pengguna Aktif
                        <small class="d-block text-muted">Top pengguna paling aktif</small>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Top Rooms -->
<div class="row mb-4">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header border-0">
                <h5 class="mb-0">5 Ruangan Paling Banyak Di-booking</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-sm mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Peringkat</th>
                            <th>Ruangan</th>
                            <th>Total Booking</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topRooms as $index => $room)
                        <tr>
                            <td>
                                <span class="badge badge-primary">{{ $index + 1 }}</span>
                            </td>
                            <td>{{ $room->nama_ruangan }}</td>
                            <td>
                                <strong>{{ $room->bookings_count }}</strong> booking
                            </td>
                            <td>
                                <a href="{{ route('staff.reports.occupancy') }}" class="btn btn-sm btn-info">Lihat Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">
                                <span class="text-muted">Tidak ada data ruangan.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header border-0">
                <h5 class="mb-0">Aksi Cepat</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('staff.dashboard') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-list"></i> Kelola Pending Booking
                    </a>
                    <a href="{{ route('staff.bookings.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-inbox"></i> Lihat Semua Booking
                    </a>
                    <hr>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-user"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pending Bookings Quick View -->
<div class="card shadow">
    <div class="card-header border-0">
        <h5 class="mb-0">5 Booking Pending Terbaru</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-sm mb-0">
            <thead class="thead-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Ruangan</th>
                    <th>Pemesan</th>
                    <th>Waktu</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendingBookings as $booking)
                <tr>
                    <td>{{ $booking->tanggal->format('d/m/Y') }}</td>
                    <td>{{ $booking->room->nama_ruangan }}</td>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</td>
                    <td>
                        <span class="badge badge-warning">Pending</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">
                        <span class="text-muted">Tidak ada booking pending.</span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <a href="{{ route('staff.dashboard') }}" class="btn btn-sm btn-primary">Lihat Semua Pending Booking</a>
    </div>
</div>

@endsection

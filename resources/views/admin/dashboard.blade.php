@extends('layouts.admin')

@section('content')
<div class="row mt-4">
    <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow admin-dashboard-card">
                <div class="card-header border-0 pb-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Dashboard Admin</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-4 pb-4">
                    <!-- Statistik Dasar -->
                    <h5 class="card-title text-uppercase text-muted mb-4">Statistik Umum</h5>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Total Ruangan</h5>
                                            <span class="h2 font-weight-bold mb-0">{{ $stats['total_rooms'] }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                                <i class="ni ni-building"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Total Booking</h5>
                                            <span class="h2 font-weight-bold mb-0">{{ $stats['total_bookings'] }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                                <i class="ni ni-calendar-grid-58"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Pending Booking</h5>
                                            <span class="h2 font-weight-bold mb-0">{{ $stats['pending_bookings'] }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-yellow text-white rounded-circle shadow">
                                                <i class="ni ni-time-alarm"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Total User</h5>
                                            <span class="h2 font-weight-bold mb-0">{{ $stats['total_users'] }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                                <i class="ni ni-single-02"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistik Aktivitas Pengguna -->
                    <h5 class="card-title text-uppercase text-muted mb-4 mt-5">Statistik Aktivitas Pengguna</h5>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Booking Hari Ini</h5>
                                            <span class="h2 font-weight-bold mb-0">{{ $stats['bookings_today'] }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                                                <i class="ni ni-folder-17"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Booking Disetujui</h5>
                                            <span class="h2 font-weight-bold mb-0">{{ $stats['approved_bookings'] }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                                <i class="ni ni-check-bold"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Booking Ditolak</h5>
                                            <span class="h2 font-weight-bold mb-0">{{ $stats['rejected_bookings'] }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-rose text-white rounded-circle shadow">
                                                <i class="ni ni-fat-remove"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Tingkat Approval</h5>
                                            <span class="h2 font-weight-bold mb-0">{{ $stats['approval_rate'] }}%</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-purple text-white rounded-circle shadow">
                                                <i class="ni ni-chart-pie-36"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistik Booking Completion -->
                    <h5 class="card-title text-uppercase text-muted mb-4 mt-5">Status Booking</h5>
                    <div class="row">
                        <div class="col-xl-6 col-md-6">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Booking Selesai</h5>
                                            <span class="h2 font-weight-bold mb-0">{{ $stats['completed_bookings'] }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-teal text-white rounded-circle shadow">
                                                <i class="ni ni-satisfied"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Rata-rata Rating Approval</h5>
                                            <span class="h2 font-weight-bold mb-0">
                                                @if($stats['total_bookings'] > 0)
                                                    {{ number_format(($stats['approved_bookings'] / $stats['total_bookings']) * 100, 1) }}%
                                                @else
                                                    0%
                                                @endif
                                            </span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-cyan text-white rounded-circle shadow">
                                                <i class="ni ni-curved-next"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


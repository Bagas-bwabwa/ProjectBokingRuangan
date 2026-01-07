@extends('layouts.staff')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h3 class="mb-0">Laporan Pengguna Paling Aktif</h3>
        <p class="text-muted">Top 10 pengguna yang paling sering melakukan booking</p>
    </div>
</div>

<!-- Overall Statistics -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total Pengguna Aktif</h6>
                <h3 class="text-primary">{{ $topUsers->count() }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total Booking</h6>
                <h3 class="text-info">{{ $topUsers->sum('total_bookings') }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Rata-rata per Pengguna</h6>
                <h3 class="text-success">
                    {{ $topUsers->count() > 0 ? round($topUsers->avg('total_bookings'), 2) : 0 }}
                </h3>
            </div>
        </div>
    </div>
</div>

<!-- Top Users Table -->
<div class="card shadow">
    <div class="card-header border-0">
        <h5 class="mb-0">Daftar Top 10 Pengguna</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="thead-light">
                <tr>
                    <th style="width: 5%">Peringkat</th>
                    <th>Nama Pengguna</th>
                    <th>Email</th>
                    <th style="width: 15%">Total Booking</th>
                    <th style="width: 15%">Approved</th>
                    <th style="width: 15%">Pending</th>
                    <th style="width: 15%">Rejected</th>
                </tr>
            </thead>
            <tbody>
                @forelse($topUsers as $index => $user)
                <tr>
                    <td>
                        <span class="badge badge-primary">{{ $index + 1 }}</span>
                    </td>
                    <td>
                        <strong>{{ $user['user_name'] }}</strong>
                    </td>
                    <td>
                        <small class="text-muted">{{ $user['user_email'] }}</small>
                    </td>
                    <td>
                        <span class="badge badge-info">{{ $user['total_bookings'] }}</span>
                    </td>
                    <td>
                        <span class="badge badge-success">{{ $user['approved_bookings'] }}</span>
                    </td>
                    <td>
                        <span class="badge badge-warning">{{ $user['pending_bookings'] }}</span>
                    </td>
                    <td>
                        <span class="badge badge-danger">{{ $user['rejected_bookings'] }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4">
                        <div class="alert alert-info mb-0">Tidak ada data pengguna yang tersedia.</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-light">
        <small class="text-muted">
            <strong>Catatan:</strong> Daftar ini menampilkan 10 pengguna dengan jumlah booking terbanyak. 
            Informasi ini berguna untuk memantau aktivitas pengguna dan mengidentifikasi pengguna yang sangat aktif dalam sistem booking.
        </small>
    </div>
</div>

<!-- Navigation Links -->
<div class="mt-4 text-center">
    <a href="{{ route('staff.reports.statistics') }}" class="btn btn-secondary">Kembali ke Statistik</a>
</div>
@endsection

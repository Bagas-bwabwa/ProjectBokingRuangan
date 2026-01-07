@extends('layouts.staff')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h3 class="mb-0">Laporan Tingkat Penggunaan Ruangan</h3>
        <p class="text-muted">Analisis occupancy rate dan penggunaan ruangan keseluruhan</p>
    </div>
</div>

<!-- Overall Statistics -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total Ruangan</h6>
                <h3 class="text-primary">{{ $rooms->count() }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total Booking</h6>
                <h3 class="text-info">{{ $rooms->sum('total_bookings') }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Approved Booking</h6>
                <h3 class="text-success">{{ $rooms->sum('approved_bookings') }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Rata-rata Occupancy</h6>
                <h3 class="text-warning">
                    {{ $rooms->count() > 0 ? round($rooms->avg('occupancy_rate'), 2) : 0 }}%
                </h3>
            </div>
        </div>
    </div>
</div>

<!-- Room Details Table -->
<div class="card shadow">
    <div class="card-header border-0">
        <h5 class="mb-0">Detail Penggunaan Per Ruangan</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-sm mb-0">
            <thead class="thead-light">
                <tr>
                    <th>Nama Ruangan</th>
                    <th>Kapasitas</th>
                    <th>Total Booking</th>
                    <th>Approved</th>
                    <th>Pending</th>
                    <th>Rejected</th>
                    <th>Occupancy Rate</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rooms as $room)
                <tr>
                    <td><strong>{{ $room['nama_ruangan'] }}</strong></td>
                    <td>{{ $room['kapasitas'] }} orang</td>
                    <td>
                        <span class="badge badge-info">{{ $room['total_bookings'] }}</span>
                    </td>
                    <td>
                        <span class="badge badge-success">{{ $room['approved_bookings'] }}</span>
                    </td>
                    <td>
                        <span class="badge badge-warning">{{ $room['pending_bookings'] }}</span>
                    </td>
                    <td>
                        <span class="badge badge-danger">{{ $room['rejected_bookings'] }}</span>
                    </td>
                    <td>
                        <div class="progress" style="height: 20px; min-width: 150px;">
                            @php $rate = $room['occupancy_rate']; @endphp
                            @if($rate < 50)
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {!! $rate !!}%;">
                                    {{ $rate }}%
                                </div>
                            @elseif($rate < 75)
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {!! $rate !!}%;">
                                    {{ $rate }}%
                                </div>
                            @else
                                <div class="progress-bar bg-success" role="progressbar" style="width: {!! $rate !!}%;">
                                    {{ $rate }}%
                                </div>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4">
                        <div class="alert alert-info mb-0">Tidak ada data ruangan tersedia.</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-light">
        <small class="text-muted">
            <strong>Occupancy Rate:</strong> Persentase booking yang disetujui dari total booking<br>
            <strong>Interpretasi:</strong> 
            <span class="badge badge-danger">0-50%</span> Rendah | 
            <span class="badge badge-warning">50-75%</span> Sedang | 
            <span class="badge badge-success">75-100%</span> Tinggi
        </small>
    </div>
</div>

<!-- Navigation Links -->
<div class="mt-4 text-center">
    <a href="{{ route('staff.reports.statistics') }}" class="btn btn-secondary">Kembali ke Statistik</a>
</div>
@endsection

@extends('layouts.staff')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h3 class="mb-0">Laporan Tingkat Persetujuan Booking</h3>
        <p class="text-muted">Analisis approval rate dan rejection rate booking</p>
    </div>
</div>

<!-- Main Statistics -->
<div class="row mb-4">
    <div class="col-md-2">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total Booking</h6>
                <h3 class="text-primary">{{ $statistics['total'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Approved</h6>
                <h3 class="text-success">{{ $statistics['approved'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Rejected</h6>
                <h3 class="text-danger">{{ $statistics['rejected'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Pending</h6>
                <h3 class="text-warning">{{ $statistics['pending'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Completed</h6>
                <h3 class="text-info">{{ $statistics['completed'] }}</h3>
            </div>
        </div>
    </div>
</div>

<!-- Rate Cards -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body text-center">
                <h6 class="text-muted">Approval Rate</h6>
                <h2 class="text-success mb-3">{{ $approvalRate }}%</h2>
                @php $approvalPercent = $approvalRate; @endphp
                <div class="progress" style="height: 30px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {!! $approvalPercent !!}%;">
                        {{ $statistics['approved'] }} dari {{ $statistics['total'] }} booking
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body text-center">
                <h6 class="text-muted">Rejection Rate</h6>
                <h2 class="text-danger mb-3">{{ $rejectionRate }}%</h2>
                @php $rejectionPercent = $rejectionRate; @endphp
                <div class="progress" style="height: 30px;">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: {!! $rejectionPercent !!}%;">
                        {{ $statistics['rejected'] }} dari {{ $statistics['total'] }} booking
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Daily Trend -->
<div class="card shadow">
    <div class="card-header border-0">
        <h5 class="mb-0">Tren Harian - Approval vs Rejection</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-sm mb-0">
            <thead class="thead-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Approved</th>
                    <th>Rejected</th>
                    <th>Pending</th>
                    <th>Approval Rate</th>
                </tr>
            </thead>
            <tbody>
                @forelse($trendData as $trend)
                <tr>
                    <td><strong>{{ \Carbon\Carbon::parse($trend['date'])->format('d/m/Y') }}</strong></td>
                    <td>
                        <span class="badge badge-info">{{ $trend['total'] }}</span>
                    </td>
                    <td>
                        <span class="badge badge-success">{{ $trend['approved'] }}</span>
                    </td>
                    <td>
                        <span class="badge badge-danger">{{ $trend['rejected'] }}</span>
                    </td>
                    <td>
                        <span class="badge badge-warning">{{ $trend['pending'] }}</span>
                    </td>
                    <td>
                        @if($trend['total'] > 0)
                            @php $trendPercent = ($trend['approved'] / $trend['total']) * 100; @endphp
                            <div class="progress" style="height: 20px; width: 150px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {!! $trendPercent !!}%;">
                                    {{ round($trendPercent, 2) }}%
                                </div>
                            </div>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4">
                        <div class="alert alert-info mb-0">Tidak ada data booking untuk ditampilkan.</div>
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

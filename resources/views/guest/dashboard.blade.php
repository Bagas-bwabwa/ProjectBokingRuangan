@extends('layouts.guest')

@section('content')
<div class="container mt--7 mb-5">
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Booking</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $stats['total_bookings'] }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                <i class="ni ni-calendar-grid-58"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Pending</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $stats['pending_bookings'] }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-warning text-white rounded-circle shadow">
                                <i class="ni ni-time-alarm"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Disetujui</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $stats['approved_bookings'] }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                                <i class="ni ni-check-bold"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Ditolak</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $stats['rejected_bookings'] }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                                <i class="ni ni-fat-remove"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bookings List -->
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Status Booking Saya</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('guest.rooms.index') }}" class="btn btn-sm btn-primary">Booking Ruangan Baru</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('guest.dashboard') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <select name="status" class="form-control">
                                    <option value="">Semua Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('guest.dashboard') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </form>

                    @if($bookings->count() > 0)
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Ruangan</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Jam</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Keperluan</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                    <tr>
                                        <td>{{ ($bookings->currentPage() - 1) * $bookings->perPage() + $loop->iteration }}</td>
                                        <td>
                                            <strong>{{ $booking->room->nama_ruangan }}</strong><br>
                                            <small class="text-muted">{{ $booking->room->category->nama_kategori }}</small>
                                        </td>
                                        <td>{{ $booking->tanggal->format('d/m/Y') }}</td>
                                        <td>{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</td>
                                        <td>
                                            @if($booking->status == 'pending')
                                                <span class="badge badge-warning badge-lg">Pending</span>
                                                <br><small class="text-muted">Menunggu persetujuan staff</small>
                                            @elseif($booking->status == 'approved')
                                                <span class="badge badge-success badge-lg">Approved</span>
                                                <br><small class="text-success"><i class="ni ni-check-bold"></i> Booking disetujui</small>
                                            @elseif($booking->status == 'rejected')
                                                <span class="badge badge-danger badge-lg">Rejected</span>
                                                <br><small class="text-danger"><i class="ni ni-fat-remove"></i> Booking ditolak</small>
                                                @if($booking->catatan)
                                                    <br><small class="text-muted">Catatan: {{ $booking->catatan }}</small>
                                                @endif
                                            @elseif($booking->status == 'completed')
                                                <span class="badge badge-info badge-lg">Completed</span>
                                                <br><small class="text-info">Selesai digunakan</small>
                                            @else
                                                <span class="badge badge-secondary badge-lg">Cancelled</span>
                                                <br><small class="text-secondary">Dibatalkan</small>
                                            @endif
                                        </td>
                                        <td>{{ Str::limit($booking->keperluan ?? '-', 30) }}</td>
                                        <td>
                                            @if($booking->status == 'pending')
                                                <span class="badge badge-warning">Menunggu</span>
                                            @elseif($booking->status == 'approved')
                                                <span class="badge badge-success">Siap Digunakan</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer py-4">
                            {{ $bookings->links() }}
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            <i class="ni ni-calendar-grid-58 fa-2x mb-3"></i>
                            <h4>Belum Ada Booking</h4>
                            <p>Anda belum melakukan booking ruangan. Silakan booking ruangan sekarang!</p>
                            <a href="{{ route('guest.rooms.index') }}" class="btn btn-primary mt-2">Cari Ruangan</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


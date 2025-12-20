@extends('layouts.staff')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3 class="mb-0">Data Booking</h3>
                </div>
                <div class="card-body">
                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('staff.bookings.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <select name="status" class="form-control">
                                    <option value="">Semua Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('staff.bookings.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </form>

                    @if($bookings->count() > 0)
                        <div class="row">
                            @foreach($bookings as $booking)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $booking->room->nama_ruangan }}</h5>
                                        <p class="card-text">
                                            <strong>Pemesan:</strong> {{ $booking->user->name }}<br>
                                            <strong>Tanggal:</strong> {{ $booking->tanggal->format('d/m/Y') }}<br>
                                            <strong>Jam:</strong> {{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}<br>
                                            <strong>Status:</strong> 
                                            @if($booking->status == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($booking->status == 'approved')
                                                <span class="badge badge-success">Approved</span>
                                            @elseif($booking->status == 'rejected')
                                                <span class="badge badge-danger">Rejected</span>
                                            @endif
                                        </p>
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('staff.bookings.show', $booking) }}" class="btn btn-sm btn-info">Detail</a>
                                            @if($booking->status == 'pending')
                                                <form action="{{ route('staff.bookings.approve', $booking) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                                </form>
                                                <form action="{{ route('staff.bookings.reject', $booking) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menolak?');">Reject</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            {{ $bookings->links() }}
                        </div>
                    @else
                        <div class="alert alert-info">
                            Tidak ada data booking.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


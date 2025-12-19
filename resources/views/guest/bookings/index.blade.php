@extends('layouts.guest')

@section('content')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3 class="mb-0">Booking Saya</h3>
                </div>
                <div class="card-body">
                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('guest.bookings.index') }}" class="mb-4">
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
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('guest.bookings.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        @forelse($bookings as $booking)
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $booking->room->nama_ruangan }}</h5>
                                    <p class="card-text">
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
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="alert alert-info">
                                Anda belum memiliki booking.
                            </div>
                        </div>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


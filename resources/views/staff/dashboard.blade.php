@extends('layouts.staff')

@section('content')
<div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3 class="mb-0">Dashboard Staff - Booking Pending</h3>
                </div>
                <div class="card-body">
                    @if($pendingBookings->count() > 0)
                        <div class="row">
                            @foreach($pendingBookings as $booking)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $booking->room->nama_ruangan }}</h5>
                                        <p class="card-text">
                                            <strong>Pemesan:</strong> {{ $booking->user->name }}<br>
                                            <strong>Tanggal:</strong> {{ $booking->tanggal->format('d/m/Y') }}<br>
                                            <strong>Jam:</strong> {{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}<br>
                                            <strong>Keperluan:</strong> {{ $booking->keperluan ?? '-' }}
                                        </p>
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('staff.bookings.show', $booking) }}" class="btn btn-sm btn-info">Detail</a>
                                            <form action="{{ route('staff.bookings.approve', $booking) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                            </form>
                                            <form action="{{ route('staff.bookings.reject', $booking) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menolak?');">Reject</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            {{ $pendingBookings->links() }}
                        </div>
                    @else
                        <div class="alert alert-info">
                            Tidak ada booking pending saat ini.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


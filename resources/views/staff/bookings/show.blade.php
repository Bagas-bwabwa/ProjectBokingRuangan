@extends('layouts.staff')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3 class="mb-0">Detail Booking</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Ruangan</dt>
                        <dd class="col-sm-9">{{ $booking->room->nama_ruangan }}</dd>
                        <dt class="col-sm-3">Pemesan</dt>
                        <dd class="col-sm-9">{{ $booking->user->name }} ({{ $booking->user->email }})</dd>
                        <dt class="col-sm-3">Tanggal</dt>
                        <dd class="col-sm-9">{{ $booking->tanggal->format('d/m/Y') }}</dd>
                        <dt class="col-sm-3">Jam</dt>
                        <dd class="col-sm-9">{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</dd>
                        <dt class="col-sm-3">Status</dt>
                        <dd class="col-sm-9">
                            @if($booking->status == 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @elseif($booking->status == 'approved')
                                <span class="badge badge-success">Approved</span>
                            @elseif($booking->status == 'rejected')
                                <span class="badge badge-danger">Rejected</span>
                            @endif
                        </dd>
                        <dt class="col-sm-3">Keperluan</dt>
                        <dd class="col-sm-9">{{ $booking->keperluan ?? '-' }}</dd>
                        @if($booking->catatan)
                        <dt class="col-sm-3">Catatan</dt>
                        <dd class="col-sm-9">{{ $booking->catatan }}</dd>
                        @endif
                    </dl>
                    @if($booking->status == 'pending')
                    <div class="mt-4">
                        <form action="{{ route('staff.bookings.approve', $booking) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                        <form action="{{ route('staff.bookings.reject', $booking) }}" method="POST" class="d-inline">
                            @csrf
                            <div class="form-group">
                                <label for="catatan">Catatan (opsional)</label>
                                <textarea name="catatan" id="catatan" class="form-control" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </form>
                    </div>
                    @endif
                    <div class="mt-4">
                        <a href="{{ route('staff.bookings.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


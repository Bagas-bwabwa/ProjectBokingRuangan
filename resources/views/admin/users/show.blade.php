@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3 class="mb-0">Detail User: {{ $user->name }}</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Nama</dt>
                        <dd class="col-sm-9">{{ $user->name }}</dd>
                        <dt class="col-sm-3">Email</dt>
                        <dd class="col-sm-9">{{ $user->email }}</dd>
                        <dt class="col-sm-3">Role</dt>
                        <dd class="col-sm-9">
                            @if($user->role == 'admin')
                                <span class="badge badge-danger">Admin</span>
                            @else
                                <span class="badge badge-info">Staff</span>
                            @endif
                        </dd>
                        <dt class="col-sm-3">Total Booking</dt>
                        <dd class="col-sm-9">{{ $user->bookings->count() }}</dd>
                    </dl>
                    <div class="mt-4">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali</a>
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


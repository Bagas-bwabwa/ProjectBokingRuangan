@php
    $user = auth()->user();
    $isAdmin = $user->isAdmin();
    $isStaff = $user->isStaff();
    $isGuest = $user->isGuest();
    
    // Tentukan layout berdasarkan role
    if ($isAdmin) {
        $layout = 'layouts.admin';
    } elseif ($isStaff) {
        $layout = 'layouts.staff';
    } else {
        $layout = 'layouts.guest';
    }
@endphp

@extends($layout)

@section('content')
<div class="row">
    <div class="col-xl-8 offset-xl-2">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">
                            <i class="ni ni-single-02 text-primary"></i> Edit Profil
                        </h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Profile Information Form -->
                <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                    @csrf
                    @method('put')

                    <h6 class="heading-small text-muted mb-4">Informasi Profil</h6>
                    
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                            <span class="alert-inner--text">{{ session('status') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if ($errors->has('not_allow_profile'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <span class="alert-inner--icon"><i class="ni ni-fat-remove"></i></span>
                            <span class="alert-inner--text">{{ $errors->first('not_allow_profile') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="pl-lg-4">
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-name">Nama Lengkap</label>
                            <input type="text" name="name" id="input-name" 
                                class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                placeholder="Masukkan nama lengkap" 
                                value="{{ old('name', $user->name) }}" 
                                required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-email">Email</label>
                            <input type="email" name="email" id="input-email" 
                                class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                placeholder="Masukkan email" 
                                value="{{ old('email', $user->email) }}" 
                                required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">Role</label>
                            <input type="text" class="form-control form-control-alternative" 
                                value="{{ ucfirst($user->role) }}" 
                                disabled>
                            <small class="text-muted">Role tidak dapat diubah</small>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-4">
                                <i class="ni ni-check-bold"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>

                <hr class="my-4">

                <!-- Password Change Form -->
                <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                    @csrf
                    @method('put')

                    <h6 class="heading-small text-muted mb-4">Ubah Password</h6>

                    @if (session('password_status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                            <span class="alert-inner--text">{{ session('password_status') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if ($errors->has('not_allow_password'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <span class="alert-inner--icon"><i class="ni ni-fat-remove"></i></span>
                            <span class="alert-inner--text">{{ $errors->first('not_allow_password') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="pl-lg-4">
                        <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-current-password">Password Saat Ini</label>
                            <input type="password" name="old_password" id="input-current-password" 
                                class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}" 
                                placeholder="Masukkan password saat ini" 
                                required>
                            
                            @if ($errors->has('old_password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('old_password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-password">Password Baru</label>
                            <input type="password" name="password" id="input-password" 
                                class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                                placeholder="Masukkan password baru (min. 6 karakter)" 
                                required>
                            
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="input-password-confirmation">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" id="input-password-confirmation" 
                                class="form-control form-control-alternative" 
                                placeholder="Masukkan ulang password baru" 
                                required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">
                                <i class="ni ni-lock-circle-open"></i> Ubah Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

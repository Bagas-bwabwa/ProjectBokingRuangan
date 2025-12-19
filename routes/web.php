<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;

// Public routes
Route::get('/', function () {
    return redirect()->route('guest.rooms.index');
})->name('home');

// Guest routes (public access)
Route::prefix('guest')->name('guest.')->group(function () {
    Route::get('/rooms', [GuestController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/{room}', [GuestController::class, 'show'])->name('rooms.show');
    
    // Booking routes (require authentication)
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [GuestController::class, 'dashboard'])->name('dashboard');
        Route::get('/rooms/{room}/booking', [GuestController::class, 'createBooking'])->name('rooms.booking');
        Route::post('/rooms/{room}/booking', [GuestController::class, 'storeBooking'])->name('bookings.store');
        Route::get('/bookings', [GuestController::class, 'myBookings'])->name('bookings.index');
    });
});

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        $stats = [
            'total_rooms' => \App\Models\Room::count(),
            'total_bookings' => \App\Models\Booking::count(),
            'pending_bookings' => \App\Models\Booking::where('status', 'pending')->count(),
            'total_users' => \App\Models\User::whereIn('role', ['admin', 'staff'])->count(),
        ];
        return view('admin.dashboard', compact('stats'));
    })->name('dashboard');

    // Categories
    Route::resource('categories', CategoryController::class);

    // Rooms
    Route::resource('rooms', RoomController::class);

    // Bookings
    Route::resource('bookings', BookingController::class);
    Route::post('/bookings/{booking}/approve', [BookingController::class, 'approve'])->name('bookings.approve');
    Route::post('/bookings/{booking}/reject', [BookingController::class, 'reject'])->name('bookings.reject');

    // Users (Admin & Staff)
    Route::resource('users', UserController::class);
});

// Staff routes
Route::prefix('staff')->name('staff.')->middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/dashboard', function () {
        $pendingBookings = \App\Models\Booking::where('status', 'pending')
            ->with(['user', 'room'])
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_mulai', 'desc')
            ->paginate(10);
        return view('staff.dashboard', compact('pendingBookings'));
    })->name('dashboard');

    // Bookings (card view)
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings/{booking}/approve', [BookingController::class, 'approve'])->name('bookings.approve');
    Route::post('/bookings/{booking}/reject', [BookingController::class, 'reject'])->name('bookings.reject');
});

// Redirect authenticated users to appropriate dashboard
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isStaff()) {
            return redirect()->route('staff.dashboard');
        } else {
            return redirect()->route('guest.dashboard');
        }
    })->name('dashboard');
});

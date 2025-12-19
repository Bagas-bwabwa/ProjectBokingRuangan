<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Category;
use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    /**
     * Display listing of rooms for guests
     */
    public function index(Request $request)
    {
        $query = Room::with('category')->where('status', 'tersedia');

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('nama_ruangan', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%')
                  ->orWhere('fasilitas', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by category
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        // Filter by capacity
        if ($request->has('kapasitas') && $request->kapasitas != '') {
            $query->where('kapasitas', '>=', $request->kapasitas);
        }

        $rooms = $query->paginate(12);
        $categories = Category::all();

        return view('guest.rooms.index', compact('rooms', 'categories'));
    }

    /**
     * Show room details
     */
    public function show(Room $room)
    {
        $room->load('category');
        
        // Get upcoming bookings for this room
        $upcomingBookings = Booking::where('room_id', $room->id)
            ->where('tanggal', '>=', now()->toDateString())
            ->whereIn('status', ['pending', 'approved'])
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->get();

        return view('guest.rooms.show', compact('room', 'upcomingBookings'));
    }

    /**
     * Show booking form
     */
    public function createBooking(Room $room)
    {
        return view('guest.bookings.create', compact('room'));
    }

    /**
     * Store booking
     */
    public function storeBooking(StoreBookingRequest $request, Room $room)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data['room_id'] = $room->id;

        // Check for booking conflicts
        $conflict = Booking::where('room_id', $room->id)
            ->where('tanggal', $data['tanggal'])
            ->where('status', '!=', 'rejected')
            ->where('status', '!=', 'cancelled')
            ->where(function($query) use ($data) {
                $query->whereBetween('jam_mulai', [$data['jam_mulai'], $data['jam_selesai']])
                      ->orWhereBetween('jam_selesai', [$data['jam_mulai'], $data['jam_selesai']])
                      ->orWhere(function($q) use ($data) {
                          $q->where('jam_mulai', '<=', $data['jam_mulai'])
                            ->where('jam_selesai', '>=', $data['jam_selesai']);
                      });
            })
            ->exists();

        if ($conflict) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ruangan sudah dipesan pada waktu tersebut.');
        }

        // Handle file upload
        if ($request->hasFile('dokumen')) {
            $data['dokumen'] = $request->file('dokumen')->store('bookings', 'public');
        }

        Booking::create($data);

        return redirect()->route('guest.dashboard')
            ->with('success', 'Booking berhasil dibuat. Menunggu persetujuan.');
    }

    /**
     * Show guest dashboard
     */
    public function dashboard(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Get statistics
        $stats = [
            'total_bookings' => Booking::where('user_id', $user->id)->count(),
            'pending_bookings' => Booking::where('user_id', $user->id)->where('status', 'pending')->count(),
            'approved_bookings' => Booking::where('user_id', $user->id)->where('status', 'approved')->count(),
            'rejected_bookings' => Booking::where('user_id', $user->id)->where('status', 'rejected')->count(),
        ];

        // Get recent bookings
        $query = Booking::where('user_id', $user->id)
            ->with('room.category');

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $bookings = $query->orderBy('tanggal', 'desc')
                         ->orderBy('jam_mulai', 'desc')
                         ->paginate(10);

        return view('guest.dashboard', compact('stats', 'bookings'));
    }

    /**
     * Show user's bookings
     */
    public function myBookings(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $query = Booking::where('user_id', Auth::id())
            ->with('room.category');

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $bookings = $query->orderBy('tanggal', 'desc')
                         ->orderBy('jam_mulai', 'desc')
                         ->paginate(10);

        return view('guest.bookings.index', compact('bookings'));
    }
}

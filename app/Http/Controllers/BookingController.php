<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'room.category']);

        // Admin sees all bookings
        // Staff sees all bookings (for processing)
        // Guest sees only their own bookings
        if (Auth::user()->isGuest()) {
            $query->where('user_id', Auth::id());
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by date
        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->where('tanggal', $request->tanggal);
        }

        // Filter by room
        if ($request->has('room_id') && $request->room_id != '') {
            $query->where('room_id', $request->room_id);
        }

        $bookings = $query->orderBy('tanggal', 'desc')
                         ->orderBy('jam_mulai', 'desc')
                         ->paginate(10);

        $rooms = Room::all();

        return view('admin.bookings.index', compact('bookings', 'rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::all();
        return view('admin.bookings.create', compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        // Check for booking conflicts
        $conflict = Booking::where('room_id', $data['room_id'])
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

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking berhasil dibuat. Menunggu persetujuan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $booking->load(['user', 'room.category']);
        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $rooms = Room::all();
        return view('admin.bookings.edit', compact('booking', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $data = $request->validated();

        // Handle file upload
        if ($request->hasFile('dokumen')) {
            // Delete old document
            if ($booking->dokumen) {
                Storage::disk('public')->delete($booking->dokumen);
            }
            $data['dokumen'] = $request->file('dokumen')->store('bookings', 'public');
        }

        $booking->update($data);

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        // Delete document if exists
        if ($booking->dokumen) {
            Storage::disk('public')->delete($booking->dokumen);
        }

        $booking->delete();

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking berhasil dihapus.');
    }

    /**
     * Approve booking (Staff only)
     */
    public function approve(Booking $booking)
    {
        $booking->update(['status' => 'approved']);

        return redirect()->back()
            ->with('success', 'Booking berhasil disetujui.');
    }

    /**
     * Reject booking (Staff only)
     */
    public function reject(Request $request, Booking $booking)
    {
        $booking->update([
            'status' => 'rejected',
            'catatan' => $request->catatan ?? null
        ]);

        return redirect()->back()
            ->with('success', 'Booking berhasil ditolak.');
    }
}

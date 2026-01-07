<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StaffController extends Controller
{
    /**
     * Menampilkan laporan harian booking
     */
    public function dailyReport(Request $request)
    {
        $date = $request->get('date', now()->toDateString());
        
        $bookings = Booking::with(['user', 'room'])
            ->whereDate('tanggal', $date)
            ->orderBy('jam_mulai', 'asc')
            ->get();

        $statistics = [
            'total_bookings' => $bookings->count(),
            'pending' => $bookings->where('status', 'pending')->count(),
            'approved' => $bookings->where('status', 'approved')->count(),
            'rejected' => $bookings->where('status', 'rejected')->count(),
            'completed' => $bookings->where('status', 'completed')->count(),
        ];

        return view('staff.reports.daily', compact('bookings', 'statistics', 'date'));
    }

    /**
     * Menampilkan laporan bulanan booking
     */
    public function monthlyReport(Request $request)
    {
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);

        $bookings = Booking::with(['user', 'room'])
            ->whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_mulai', 'desc')
            ->get();

        // Statistik berdasarkan status
        $statusStats = [
            'pending' => $bookings->where('status', 'pending')->count(),
            'approved' => $bookings->where('status', 'approved')->count(),
            'rejected' => $bookings->where('status', 'rejected')->count(),
            'completed' => $bookings->where('status', 'completed')->count(),
        ];

        // Statistik per ruangan
        $roomStats = $bookings->groupBy('room_id')
            ->map(function ($items) {
                return [
                    'room_name' => $items->first()->room->nama_ruangan,
                    'total' => $items->count(),
                    'approved' => $items->where('status', 'approved')->count(),
                ];
            });

        $monthName = Carbon::createFromDate($year, $month, 1)->format('F Y');

        return view('staff.reports.monthly', compact('bookings', 'statusStats', 'roomStats', 'month', 'year', 'monthName'));
    }

    /**
     * Menampilkan laporan ruangan (occupancy rate)
     */
    public function roomOccupancyReport()
    {
        $rooms = Room::with('bookings')
            ->get()
            ->map(function ($room) {
                $totalBookings = $room->bookings->count();
                $approvedBookings = $room->bookings->where('status', 'approved')->count();
                
                return [
                    'id' => $room->id,
                    'nama_ruangan' => $room->nama_ruangan,
                    'kapasitas' => $room->kapasitas,
                    'total_bookings' => $totalBookings,
                    'approved_bookings' => $approvedBookings,
                    'pending_bookings' => $room->bookings->where('status', 'pending')->count(),
                    'rejected_bookings' => $room->bookings->where('status', 'rejected')->count(),
                    'occupancy_rate' => $totalBookings > 0 ? round(($approvedBookings / $totalBookings) * 100, 2) : 0,
                ];
            });

        return view('staff.reports.room-occupancy', compact('rooms'));
    }

    /**
     * Menampilkan laporan status booking (approval rate)
     */
    public function approvalRateReport()
    {
        $bookings = Booking::with(['user', 'room'])
            ->orderBy('created_at', 'desc')
            ->get();

        $statistics = [
            'total' => $bookings->count(),
            'pending' => $bookings->where('status', 'pending')->count(),
            'approved' => $bookings->where('status', 'approved')->count(),
            'rejected' => $bookings->where('status', 'rejected')->count(),
            'completed' => $bookings->where('status', 'completed')->count(),
        ];

        $approvalRate = $statistics['total'] > 0 
            ? round(($statistics['approved'] / $statistics['total']) * 100, 2)
            : 0;

        $rejectionRate = $statistics['total'] > 0 
            ? round(($statistics['rejected'] / $statistics['total']) * 100, 2)
            : 0;

        // Grouping berdasarkan tanggal untuk trend
        $trendData = $bookings->groupBy(function ($item) {
            return $item->created_at->toDateString();
        })->map(function ($items) {
            return [
                'date' => $items->first()->created_at->toDateString(),
                'total' => $items->count(),
                'approved' => $items->where('status', 'approved')->count(),
                'rejected' => $items->where('status', 'rejected')->count(),
                'pending' => $items->where('status', 'pending')->count(),
            ];
        });

        return view('staff.reports.approval-rate', compact('statistics', 'approvalRate', 'rejectionRate', 'trendData'));
    }

    /**
     * Menampilkan laporan user yang paling aktif booking
     */
    public function topUsersReport()
    {
        $topUsers = Booking::with('user')
            ->groupBy('user_id')
            ->selectRaw('user_id, count(*) as total_bookings')
            ->orderBy('total_bookings', 'desc')
            ->limit(10)
            ->get();

        $topUsers = $topUsers->map(function ($booking) {
            $userBookings = $booking->user->bookings;
            return [
                'user_name' => $booking->user->name,
                'user_email' => $booking->user->email,
                'total_bookings' => $booking->total_bookings,
                'approved_bookings' => $userBookings->where('status', 'approved')->count(),
                'pending_bookings' => $userBookings->where('status', 'pending')->count(),
                'rejected_bookings' => $userBookings->where('status', 'rejected')->count(),
            ];
        });

        return view('staff.reports.top-users', compact('topUsers'));
    }

    /**
     * Menampilkan dashboard statistik keseluruhan
     */
    public function statisticsDashboard()
    {
        $today = now()->toDateString();
        
        // Statistik harian
        $dailyStats = [
            'bookings_today' => Booking::whereDate('tanggal', $today)->count(),
            'pending_today' => Booking::whereDate('tanggal', $today)->where('status', 'pending')->count(),
            'approved_today' => Booking::whereDate('tanggal', $today)->where('status', 'approved')->count(),
        ];

        // Statistik bulan ini
        $thisMonth = now();
        $monthlyStats = [
            'total_bookings' => Booking::whereMonth('created_at', $thisMonth->month)->whereYear('created_at', $thisMonth->year)->count(),
            'pending' => Booking::whereMonth('created_at', $thisMonth->month)->whereYear('created_at', $thisMonth->year)->where('status', 'pending')->count(),
            'approved' => Booking::whereMonth('created_at', $thisMonth->month)->whereYear('created_at', $thisMonth->year)->where('status', 'approved')->count(),
        ];

        // Statistik keseluruhan
        $overallStats = [
            'total_bookings' => Booking::count(),
            'total_approved' => Booking::where('status', 'approved')->count(),
            'total_rejected' => Booking::where('status', 'rejected')->count(),
            'total_completed' => Booking::where('status', 'completed')->count(),
            'approval_rate' => Booking::count() > 0 ? round((Booking::where('status', 'approved')->count() / Booking::count()) * 100, 2) : 0,
        ];

        // Top 5 ruangan yang paling banyak di-booking
        $topRooms = Room::withCount(['bookings'])
            ->orderBy('bookings_count', 'desc')
            ->limit(5)
            ->get();

        // Pending bookings untuk quick action
        $pendingBookings = Booking::where('status', 'pending')
            ->with(['user', 'room'])
            ->orderBy('tanggal', 'asc')
            ->limit(5)
            ->get();

        return view('staff.reports.statistics', compact('dailyStats', 'monthlyStats', 'overallStats', 'topRooms', 'pendingBookings'));
    }
}

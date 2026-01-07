# Route Testing dan Contoh Penggunaan

## Named Routes yang Tersedia

Semua routes untuk staff reports menggunakan named routes, sehingga bisa di-reference di views/controllers:

```php
route('staff.reports.statistics')    // Dashboard statistik utama
route('staff.reports.daily')         // Laporan harian
route('staff.reports.monthly')       // Laporan bulanan
route('staff.reports.occupancy')     // Laporan occupancy rate
route('staff.reports.approval')      // Laporan approval rate
route('staff.reports.top-users')     // Laporan top users
```

## URL Paths

```
GET /staff/reports/statistics    → Dashboard statistik utama
GET /staff/reports/daily         → Laporan harian
GET /staff/reports/monthly       → Laporan bulanan
GET /staff/reports/occupancy     → Laporan occupancy rate
GET /staff/reports/approval      → Laporan approval rate
GET /staff/reports/top-users     → Laporan top users
```

## Query Parameters

### Daily Report
```
GET /staff/reports/daily?date=2026-01-15
```

Params:
- `date` (optional): Format YYYY-MM-DD, default hari ini

### Monthly Report
```
GET /staff/reports/monthly?month=1&year=2026
```

Params:
- `month` (optional): 1-12, default bulan sekarang
- `year` (optional): YYYY, default tahun sekarang

## Controller Methods

File: `app/Http/Controllers/StaffController.php`

```php
public function statisticsDashboard()     // GET /staff/reports/statistics
public function dailyReport(Request $req)  // GET /staff/reports/daily
public function monthlyReport(Request $req) // GET /staff/reports/monthly
public function roomOccupancyReport()      // GET /staff/reports/occupancy
public function approvalRateReport()       // GET /staff/reports/approval
public function topUsersReport()           // GET /staff/reports/top-users
```

## Testing dengan Browser

### Test 1: Dashboard Statistik
```
URL: http://localhost/staff/reports/statistics
Expected: Melihat overview statistik dengan cards dan menu laporan
```

### Test 2: Laporan Harian - Today
```
URL: http://localhost/staff/reports/daily
Expected: Melihat booking hari ini
```

### Test 3: Laporan Harian - Filter Date
```
URL: http://localhost/staff/reports/daily?date=2025-12-25
Expected: Melihat booking pada 25 Desember 2025 (jika ada)
```

### Test 4: Laporan Bulanan - Current Month
```
URL: http://localhost/staff/reports/monthly
Expected: Melihat statistik bulan sekarang
```

### Test 5: Laporan Bulanan - Filter
```
URL: http://localhost/staff/reports/monthly?month=12&year=2025
Expected: Melihat statistik Desember 2025
```

### Test 6: Laporan Occupancy
```
URL: http://localhost/staff/reports/occupancy
Expected: Melihat semua ruangan dengan occupancy rate mereka
```

### Test 7: Laporan Approval Rate
```
URL: http://localhost/staff/reports/approval
Expected: Melihat approval rate dan tren harian
```

### Test 8: Laporan Top Users
```
URL: http://localhost/staff/reports/top-users
Expected: Melihat 10 pengguna paling aktif
```

## Testing dari Blade Template

Dalam views, gunakan helper `route()`:

```blade
<!-- Link ke dashboard statistik -->
<a href="{{ route('staff.reports.statistics') }}">Lihat Statistik</a>

<!-- Link ke laporan harian dengan filter -->
<a href="{{ route('staff.reports.daily', ['date' => '2026-01-15']) }}">
    Lihat Booking 15 Januari
</a>

<!-- Link ke laporan bulanan -->
<a href="{{ route('staff.reports.monthly', ['month' => 1, 'year' => 2026]) }}">
    Januari 2026
</a>
```

## Testing dari Controller

Dalam controller, gunakan `redirect()`:

```php
// Redirect ke dashboard statistik
return redirect()->route('staff.reports.statistics');

// Redirect dengan query params
return redirect()->route('staff.reports.daily', ['date' => '2026-01-15']);

// Redirect dengan pesan
return redirect()->route('staff.reports.statistics')
    ->with('success', 'Laporan berhasil di-generate');
```

## Middleware & Security

Semua routes dilindungi:

```php
Route::middleware(['auth', 'role:staff'])->group(function () {
    // Staff reports routes...
});
```

Middleware checks:
- `auth`: User harus login
- `role:staff`: User harus memiliki role 'staff'

## Query Optimization

Controller menggunakan eager loading untuk optimize queries:

```php
// Contoh: Dalam monthlyReport()
Booking::with(['user', 'room'])
    ->whereYear('tanggal', $year)
    ->whereMonth('tanggal', $month)
    ->get();
```

Benefits:
- ✅ Menghindari N+1 query problem
- ✅ Performa lebih cepat
- ✅ Load relations efficiently

## Data Flow

1. **Request masuk** → `/staff/reports/daily?date=2026-01-15`
2. **Route matches** → Calls `StaffController@dailyReport`
3. **Controller processes**:
   - Ambil query param `date`
   - Query database dengan filter
   - Calculate statistics
   - Return dengan view + data
4. **View renders** → Blade template process data dan tampilkan
5. **Response** → HTML dikirim ke browser

## Error Handling

Jika query params invalid:
- **Invalid date format**: Laravel akan handle automatic casting
- **Empty results**: View akan show "No data" message
- **Permission denied**: Middleware akan redirect ke login

## Performance Notes

- Queries di-optimize dengan eager loading
- Statistical calculations dilakukan di PHP (bukan SQL)
- Pagination tidak digunakan (data smaller sets)
- Cache: Bisa ditambahkan later jika perlu

## Future Enhancements

Fitur yang bisa ditambahkan:
- [ ] Export laporan ke PDF
- [ ] Export laporan ke Excel
- [ ] Scheduled email reports
- [ ] Custom date ranges
- [ ] Advanced filtering
- [ ] Data visualization dengan charts
- [ ] Comparison antar periode
- [ ] Dashboard customization

---

**Version**: 1.0
**Last Updated**: January 2026

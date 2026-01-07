# Fitur Laporan & Data Staff

## Deskripsi
Fitur ini memungkinkan staff untuk melihat laporan dan data yang relevan dengan tugas mereka dalam sistem booking ruangan. Staff dapat mengakses berbagai laporan untuk menganalisis data booking, penggunaan ruangan, tingkat persetujuan, dan aktivitas pengguna.

## Fitur-Fitur yang Tersedia

### 1. Dashboard Statistik Utama (`/staff/reports/statistics`)
Dashboard ringkasan yang menampilkan:
- **Statistik Harian**: Booking hari ini, pending, approved, dan approval rate
- **Statistik Bulanan**: Total booking bulan ini, pending, dan approved
- **Statistik Keseluruhan**: Total booking, approved, rejected, completed, dan approval rate
- **Top 5 Ruangan**: Ruangan paling banyak di-booking
- **5 Booking Pending Terbaru**: Quick view pending bookings
- **Menu Laporan**: Link cepat ke semua laporan

### 2. Laporan Booking Harian (`/staff/reports/daily`)
Menampilkan data booking per hari dengan fitur:
- Filter berdasarkan tanggal
- Statistik harian: total, pending, approved, rejected, completed
- Tabel detail booking dengan waktu, ruangan, pemesan, keperluan, dan status
- Navigasi back ke dashboard statistik

### 3. Laporan Booking Bulanan (`/staff/reports/monthly`)
Menampilkan data booking per bulan dengan fitur:
- Filter bulan dan tahun
- Statistik status booking (pending, approved, rejected, completed)
- Tabel statistik penggunaan ruangan per bulan
- Tabel detail booking bulanan
- Progress bar untuk visualisasi approval rate per ruangan

### 4. Laporan Penggunaan Ruangan (Occupancy Rate) (`/staff/reports/occupancy`)
Menampilkan analisis penggunaan ruangan:
- Total ruangan dan statistik booking keseluruhan
- Rata-rata occupancy rate
- Tabel detail per ruangan dengan:
  - Kapasitas ruangan
  - Total booking dan breakdown (approved, pending, rejected)
  - Occupancy rate dengan color coding:
    - Merah (0-50%): Rendah
    - Kuning (50-75%): Sedang
    - Hijau (75-100%): Tinggi

### 5. Laporan Tingkat Persetujuan (`/staff/reports/approval`)
Menampilkan analisis approval dan rejection rate:
- Statistik booking per status (pending, approved, rejected, completed)
- Approval Rate dalam bentuk percentage dan progress bar
- Rejection Rate dalam bentuk percentage dan progress bar
- Tren harian dengan tabel showing approval rate per tanggal
- Informasi historis untuk melihat trend approval rate

### 6. Laporan Pengguna Paling Aktif (`/staff/reports/top-users`)
Menampilkan top 10 pengguna yang paling aktif:
- Total pengguna aktif dan statistik booking
- Rata-rata booking per pengguna
- Tabel top 10 pengguna dengan breakdown:
  - Total booking
  - Approved booking
  - Pending booking
  - Rejected booking

## Routes yang Ditambahkan

```php
Route::prefix('staff/reports')->name('staff.reports.')->middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/statistics', [StaffController::class, 'statisticsDashboard'])->name('statistics');
    Route::get('/daily', [StaffController::class, 'dailyReport'])->name('daily');
    Route::get('/monthly', [StaffController::class, 'monthlyReport'])->name('monthly');
    Route::get('/occupancy', [StaffController::class, 'roomOccupancyReport'])->name('occupancy');
    Route::get('/approval', [StaffController::class, 'approvalRateReport'])->name('approval');
    Route::get('/top-users', [StaffController::class, 'topUsersReport'])->name('top-users');
});
```

## Controller yang Dibuat

File: `app/Http/Controllers/StaffController.php`

Methods:
- `statisticsDashboard()` - Dashboard statistik utama
- `dailyReport()` - Laporan harian dengan filter tanggal
- `monthlyReport()` - Laporan bulanan dengan filter bulan/tahun
- `roomOccupancyReport()` - Analisis occupancy rate per ruangan
- `approvalRateReport()` - Laporan tingkat persetujuan
- `topUsersReport()` - Top 10 pengguna paling aktif

## Views yang Dibuat

Semua file views terletak di `resources/views/staff/reports/`:
- `statistics.blade.php` - Dashboard statistik utama
- `daily.blade.php` - Laporan harian
- `monthly.blade.php` - Laporan bulanan
- `room-occupancy.blade.php` - Occupancy rate
- `approval-rate.blade.php` - Tingkat persetujuan
- `top-users.blade.php` - Pengguna aktif

## Akses Fitur

Staff dapat mengakses fitur laporan melalui:

1. **Dari Dashboard Staff**: Klik tombol "Lihat Laporan & Statistik" di bagian atas
2. **URL Langsung**: `/staff/reports/statistics`
3. **Menu Laporan**: Dari dashboard statistik, pilih laporan yang diinginkan

## Keamanan

Semua routes laporan staff dilindungi dengan middleware:
- `auth` - Hanya user yang login
- `role:staff` - Hanya user dengan role staff

## Teknologi yang Digunakan

- **Framework**: Laravel
- **Templating**: Blade
- **Styling**: Bootstrap 5
- **Visualization**: Progress bars, badges, cards
- **Data Processing**: PHP collections dan Carbon library

## Fitur Tambahan pada Dashboard Staff

Dashboard staff telah diupdate dengan:
- Tombol quick access ke laporan dan statistik
- Quick stats cards untuk overview
- Link langsung ke laporan detail
- Informasi yang lebih komprehensif

## Cara Menggunakan

1. Login sebagai staff
2. Dari dashboard, klik "Lihat Laporan & Statistik"
3. Pilih laporan yang ingin dilihat:
   - Laporan Booking Harian: Analisis per hari
   - Laporan Booking Bulanan: Analisis per bulan
   - Laporan Penggunaan Ruangan: Occupancy rate per ruangan
   - Laporan Tingkat Persetujuan: Approval/rejection trend
   - Laporan Pengguna Aktif: Top pengguna dengan booking terbanyak
4. Gunakan filter (jika tersedia) untuk customize data
5. Analisis data dan buat keputusan berdasarkan insight yang diperoleh

## Manfaat Fitur

✅ **Visibility**: Staff dapat melihat semua data yang relevan dengan tugasnya
✅ **Analysis**: Fitur laporan membantu menganalisis trend dan pola booking
✅ **Monitoring**: Monitoring approval rate dan rejection rate
✅ **Decision Making**: Data-driven decision making untuk meningkatkan efisiensi
✅ **User Management**: Identifikasi pengguna yang paling aktif
✅ **Resource Planning**: Analisis penggunaan ruangan untuk planning lebih baik

---
**Created**: January 2026
**Version**: 1.0

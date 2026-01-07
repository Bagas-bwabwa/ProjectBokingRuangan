# PANDUAN SINGKAT FITUR STAFF REPORTS

## Apa yang Baru?

Staff sekarang dapat melihat **6 jenis laporan berbeda** yang membantu mereka menganalisis data booking dan membuat keputusan yang lebih baik.

## Cara Mengakses

### Opsi 1: Dari Dashboard Staff
1. Login sebagai staff
2. Di dashboard, klik tombol **"Lihat Laporan & Statistik"** (warna biru)
3. Anda akan dibawa ke halaman utama laporan

### Opsi 2: Akses Langsung
Masukkan URL: `http://your-app.com/staff/reports/statistics`

## 6 Laporan yang Tersedia

### 1. 📊 Dashboard Statistik (Halaman Utama)
**URL**: `/staff/reports/statistics`

Menampilkan ringkasan lengkap:
- Statistik booking hari ini, bulan ini, dan keseluruhan
- 5 ruangan paling banyak di-booking
- 5 pending booking terbaru
- Menu akses cepat ke semua laporan

### 2. 📅 Laporan Harian
**URL**: `/staff/reports/daily`

Fitur:
- Filter berdasarkan tanggal
- Lihat semua booking pada tanggal tertentu
- Statistik pending, approved, rejected, completed per hari

**Contoh**: Lihat detail semua booking pada tanggal 10 Januari 2026

### 3. 📆 Laporan Bulanan
**URL**: `/staff/reports/monthly`

Fitur:
- Filter bulan dan tahun
- Statistik penggunaan ruangan per bulan
- Detail semua booking dalam bulan tersebut
- Progress bar approval rate per ruangan

**Contoh**: Analisis booking Januari 2026 dan melihat ruangan mana yang paling banyak di-booking

### 4. 🏢 Laporan Penggunaan Ruangan (Occupancy Rate)
**URL**: `/staff/reports/occupancy`

Fitur:
- Occupancy rate per ruangan
- Color coding: Merah (rendah), Kuning (sedang), Hijau (tinggi)
- Statistik per ruangan (total, approved, pending, rejected)

**Contoh**: Lihat ruangan mana yang paling sering di-booking dan mana yang jarang digunakan

### 5. ✅ Laporan Tingkat Persetujuan
**URL**: `/staff/reports/approval`

Fitur:
- Approval Rate dan Rejection Rate
- Tren harian approval rate
- Progress visualization
- Detail per tanggal

**Contoh**: Monitor seberapa banyak booking yang disetujui vs ditolak

### 6. 👥 Laporan Pengguna Aktif
**URL**: `/staff/reports/top-users`

Fitur:
- Top 10 pengguna paling aktif
- Breakdown: total, approved, pending, rejected booking
- Rata-rata booking per pengguna

**Contoh**: Identifikasi pengguna yang paling sering booking

## Fitur Utama

✅ **Filter Data**: Laporan harian dan bulanan bisa di-filter
✅ **Real-time**: Semua data fresh dari database
✅ **Visual**: Progress bars, badges, cards untuk kemudahan membaca
✅ **Navigation**: Easy back and forth antar laporan
✅ **Responsive**: Bisa diakses dari desktop, tablet, mobile

## Tips Penggunaan

1. **Start dari Dashboard**: Mulai dari statistik utama untuk overview
2. **Drill Down**: Klik laporan spesifik untuk detail lebih lanjut
3. **Filter**: Gunakan filter untuk melihat data periode tertentu
4. **Compare**: Bandingkan data antar periode untuk trend analysis
5. **Export Manual**: Jika perlu, capture screenshot untuk laporan

## Data yang Ditampilkan

### Statistik Dasar
- Total booking
- Pending, Approved, Rejected, Completed booking
- Approval rate percentage

### Breakdown Per Ruangan
- Nama ruangan
- Kapasitas
- Total booking
- Status breakdown
- Occupancy rate

### Per User
- Nama pengguna
- Email
- Total booking
- Status breakdown

### Temporal Data
- Per hari
- Per bulan
- Trend harian/mingguan

## Keyboard Shortcuts (Coming Soon)

Saat ini tidak ada keyboard shortcuts, tapi navigasi penuh bisa dilakukan dengan mouse/touchpad.

## Troubleshooting

### "Akses Ditolak"
- Pastikan Anda login sebagai staff
- Periksa role Anda di database (harus `staff`)

### "Data Tidak Muncul"
- Pastikan ada data booking di sistem
- Coba filter date/month lain
- Refresh halaman

### "Laporan Berubah"
- Laporan menampilkan real-time data
- Jika ada booking baru, laporan akan update otomatis

## Contact & Support

Jika ada pertanyaan atau masalah dengan fitur laporan, silakan hubungi administrator.

---
**Version**: 1.0
**Last Updated**: January 2026

Enjoy the new reports feature! 🎉

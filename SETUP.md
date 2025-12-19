# Setup Aplikasi Booking Ruangan

## Instalasi & Setup

1. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

2. **Setup Environment**
   - Copy `.env.example` ke `.env` (jika belum ada)
   - Generate application key:
     ```bash
     php artisan key:generate
     ```

3. **Setup Database**
   - Konfigurasi database di `.env`
   - Jalankan migrations:
     ```bash
     php artisan migrate
     ```
   - Jalankan seeders:
     ```bash
     php artisan db:seed
     ```

4. **Setup Storage Link**
   - Buat symbolic link untuk storage:
     ```bash
     php artisan storage:link
     ```

5. **Jalankan Aplikasi**
   ```bash
   php artisan serve
   ```

## Akun Default

Setelah menjalankan seeder, akun berikut tersedia:

### Admin
- Email: `admin@booking.com`
- Password: `password`

### Staff
- Email: `staff1@booking.com` atau `staff2@booking.com`
- Password: `password`

### Guest
- Email: `guest@booking.com`
- Password: `password`

## Struktur Aplikasi

### Role & Hak Akses

1. **Admin**
   - Akses penuh ke semua fitur
   - CRUD Kategori Ruangan
   - CRUD Ruangan
   - CRUD Booking
   - CRUD User (Admin & Staff)
   - Tampilan menggunakan tabel

2. **Staff**
   - Memproses booking (approve/reject)
   - Melihat daftar booking
   - Tampilan menggunakan card view (bukan tabel)

3. **Guest**
   - Melihat daftar ruangan
   - Melakukan booking ruangan
   - Melihat booking sendiri
   - Akses publik tanpa login

### Routes

- `/` - Halaman utama (redirect ke guest rooms)
- `/guest/rooms` - Daftar ruangan (public)
- `/guest/rooms/{room}` - Detail ruangan
- `/admin/*` - Routes admin (protected)
- `/staff/*` - Routes staff (protected)

### Fitur yang Diimplementasikan

✅ **CRUD Lengkap**
- Categories (Kategori Ruangan)
- Rooms (Ruangan)
- Bookings (Booking)
- Users (Admin & Staff)

✅ **Authentication & Authorization**
- Login/Logout
- Middleware role-based access
- Proteksi route berdasarkan role

✅ **File Upload**
- Upload foto ruangan
- Upload dokumen pendukung booking

✅ **Pagination, Filter, Search**
- Pagination untuk semua data
- Filter berdasarkan status, tanggal, kategori
- Search untuk ruangan dan kategori

✅ **Partial Views**
- Header, Sidebar, Footer terpisah
- Layout templates untuk Admin, Staff, Guest

✅ **Form Validation**
- Request validation classes
- Client-side dan server-side validation

✅ **Seeders**
- User seeder (Admin, Staff, Guest)
- Category seeder
- Room seeder

## Catatan Penting

1. **Storage Link**: Pastikan menjalankan `php artisan storage:link` untuk mengaktifkan upload file
2. **Database**: Pastikan database sudah dikonfigurasi dengan benar di `.env`
3. **Template**: Aplikasi menggunakan template Argon Dashboard

## Struktur Database

- `users` - Tabel user dengan role (admin, staff, guest)
- `categories` - Kategori ruangan
- `rooms` - Data ruangan
- `bookings` - Data booking

## Troubleshooting

1. **Error Storage Link**: Pastikan folder `storage/app/public` ada dan writable
2. **Error Migration**: Pastikan database sudah dikonfigurasi dengan benar
3. **Error Upload File**: Pastikan storage link sudah dibuat dan folder writable


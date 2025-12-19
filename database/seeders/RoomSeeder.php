<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\Category;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->command->warn('Categories not found. Please run CategorySeeder first.');
            return;
        }

        // Ruang Meeting
        Room::create([
            'nama_ruangan' => 'Meeting Room A',
            'kapasitas' => 20,
            'category_id' => $categories->where('nama_kategori', 'Ruang Meeting')->first()->id,
            'status' => 'tersedia',
            'deskripsi' => 'Ruang meeting dengan fasilitas lengkap',
            'fasilitas' => 'Proyektor, Whiteboard, AC, Sound System',
        ]);

        Room::create([
            'nama_ruangan' => 'Meeting Room B',
            'kapasitas' => 15,
            'category_id' => $categories->where('nama_kategori', 'Ruang Meeting')->first()->id,
            'status' => 'tersedia',
            'deskripsi' => 'Ruang meeting kecil untuk diskusi',
            'fasilitas' => 'Whiteboard, AC',
        ]);

        // Ruang Kelas
        Room::create([
            'nama_ruangan' => 'Kelas 101',
            'kapasitas' => 40,
            'category_id' => $categories->where('nama_kategori', 'Ruang Kelas')->first()->id,
            'status' => 'tersedia',
            'deskripsi' => 'Ruang kelas standar',
            'fasilitas' => 'Proyektor, Papan Tulis, AC',
        ]);

        Room::create([
            'nama_ruangan' => 'Kelas 102',
            'kapasitas' => 40,
            'category_id' => $categories->where('nama_kategori', 'Ruang Kelas')->first()->id,
            'status' => 'tersedia',
            'deskripsi' => 'Ruang kelas standar',
            'fasilitas' => 'Proyektor, Papan Tulis, AC',
        ]);

        // Auditorium
        Room::create([
            'nama_ruangan' => 'Auditorium Utama',
            'kapasitas' => 200,
            'category_id' => $categories->where('nama_kategori', 'Auditorium')->first()->id,
            'status' => 'tersedia',
            'deskripsi' => 'Auditorium besar untuk acara besar',
            'fasilitas' => 'Panggung, Sound System, Proyektor, AC',
        ]);

        // Laboratorium
        Room::create([
            'nama_ruangan' => 'Lab Komputer 1',
            'kapasitas' => 30,
            'category_id' => $categories->where('nama_kategori', 'Laboratorium')->first()->id,
            'status' => 'tersedia',
            'deskripsi' => 'Laboratorium komputer',
            'fasilitas' => 'Komputer, Proyektor, AC',
        ]);

        // Ruang Serbaguna
        Room::create([
            'nama_ruangan' => 'Ruang Serbaguna A',
            'kapasitas' => 50,
            'category_id' => $categories->where('nama_kategori', 'Ruang Serbaguna')->first()->id,
            'status' => 'tersedia',
            'deskripsi' => 'Ruang untuk berbagai kegiatan',
            'fasilitas' => 'Proyektor, Sound System, AC',
        ]);
    }
}

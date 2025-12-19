<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'nama_kategori' => 'Ruang Meeting',
            'deskripsi' => 'Ruang untuk pertemuan dan rapat',
        ]);

        Category::create([
            'nama_kategori' => 'Ruang Kelas',
            'deskripsi' => 'Ruang untuk kegiatan belajar mengajar',
        ]);

        Category::create([
            'nama_kategori' => 'Auditorium',
            'deskripsi' => 'Ruang besar untuk acara dan presentasi',
        ]);

        Category::create([
            'nama_kategori' => 'Laboratorium',
            'deskripsi' => 'Ruang untuk praktikum dan penelitian',
        ]);

        Category::create([
            'nama_kategori' => 'Ruang Serbaguna',
            'deskripsi' => 'Ruang untuk berbagai kegiatan',
        ]);
    }
}

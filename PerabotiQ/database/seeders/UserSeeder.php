<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Produk;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@perabotiq.com'],
            [
                'name'     => 'Admin PerabotiQ',
                'password' => bcrypt('admin123'),
                'role'     => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'kurir@perabotiq.com'],
            [
                'name'     => 'Kurir PerabotiQ',
                'password' => bcrypt('kurir123'),
                'role'     => 'kurir',
            ]
        );

        // Seed sample products into produks table
        $products = [
            ['nama' => 'KIVIK Sofa', 'kategori' => 'ruang-tamu', 'deskripsi' => 'Sofa 3 dudukan yang sangat nyaman.', 'harga' => 4500000, 'stok' => 15, 'gambar' => 'assets/img/KIVIK.png'],
            ['nama' => 'POANG Armchair', 'kategori' => 'ruang-tamu', 'deskripsi' => 'Kursi santai berdesain klasik.', 'harga' => 1200000, 'stok' => 25, 'gambar' => 'assets/img/POANG.png'],
            ['nama' => 'STRANDMON', 'kategori' => 'ruang-tamu', 'deskripsi' => 'Kursi sayap klasik.', 'harga' => 2500000, 'stok' => 10, 'gambar' => 'assets/img/STRANDMON.png'],
            ['nama' => 'MALM Bed', 'kategori' => 'ruang-tidur', 'deskripsi' => 'Rangka tempat tidur tinggi.', 'harga' => 3200000, 'stok' => 8, 'gambar' => 'assets/img/MALM.png'],
            ['nama' => 'HAUGA', 'kategori' => 'ruang-tidur', 'deskripsi' => 'Lemari pakaian pintu geser.', 'harga' => 2800000, 'stok' => 12, 'gambar' => 'assets/img/HAUGA.png'],
            ['nama' => 'TARVA', 'kategori' => 'ruang-tidur', 'deskripsi' => 'Rangka tempat tidur pinus solid.', 'harga' => 1900000, 'stok' => 20, 'gambar' => 'assets/img/TARVA.png'],
            ['nama' => 'EKEDALEN Table', 'kategori' => 'ruang-makan', 'deskripsi' => 'Meja makan dapat dipanjangkan.', 'harga' => 3500000, 'stok' => 5, 'gambar' => 'assets/img/EKEDALEN.png'],
            ['nama' => 'NORDEN', 'kategori' => 'ruang-makan', 'deskripsi' => 'Meja lipat berbahan kayu solid.', 'harga' => 2100000, 'stok' => 10, 'gambar' => 'assets/img/NORDEN.png'],
            ['nama' => 'PINNTORP', 'kategori' => 'ruang-makan', 'deskripsi' => 'Meja kayu sederhana namun kokoh.', 'harga' => 1800000, 'stok' => 18, 'gambar' => 'assets/img/PINNTORP.png'],
            ['nama' => 'MICKE Desk', 'kategori' => 'ruang-kerja', 'deskripsi' => 'Meja kerja dengan penyimpanan.', 'harga' => 1400000, 'stok' => 30, 'gambar' => 'assets/img/MICKE.png'],
            ['nama' => 'FLINTAN', 'kategori' => 'ruang-kerja', 'deskripsi' => 'Kursi kantor putar yang ergonomis.', 'harga' => 999000, 'stok' => 45, 'gambar' => 'assets/img/FLINTAN.png'],
            ['nama' => 'TROTTEN', 'kategori' => 'ruang-kerja', 'deskripsi' => 'Meja kerja fleksibel.', 'harga' => 1750000, 'stok' => 12, 'gambar' => 'assets/img/TROTTEN.png'],
            ['nama' => 'BROGRUND', 'kategori' => 'kamar-mandi', 'deskripsi' => 'Set shower dengan pengatur suhu.', 'harga' => 1100000, 'stok' => 20, 'gambar' => 'assets/img/BROGRUND.png'],
            ['nama' => 'TVALLEN', 'kategori' => 'kamar-mandi', 'deskripsi' => 'Wastafel minimalis.', 'harga' => 1600000, 'stok' => 15, 'gambar' => 'assets/img/TVALLEN.png'],
            ['nama' => 'VALLAMOSSE', 'kategori' => 'kamar-mandi', 'deskripsi' => 'Shower set lengkap.', 'harga' => 850000, 'stok' => 22, 'gambar' => 'assets/img/VALLAMOSSE.png'],
            ['nama' => 'BILLY Bookcase', 'kategori' => 'aksesoris', 'deskripsi' => 'Rak buku serbaguna.', 'harga' => 950000, 'stok' => 50, 'gambar' => 'assets/img/BILLY.png'],
            ['nama' => 'FROJDA', 'kategori' => 'aksesoris', 'deskripsi' => 'Hiasan meja modern.', 'harga' => 150000, 'stok' => 100, 'gambar' => 'assets/img/FROJDA.png'],
            ['nama' => 'FONSTERBLAD', 'kategori' => 'aksesoris', 'deskripsi' => 'Tanaman hias dalam pot.', 'harga' => 85000, 'stok' => 150, 'gambar' => 'assets/img/FONSTERBLAD.png'],
        ];

        foreach ($products as $p) {
            Produk::updateOrCreate(['nama' => $p['nama']], $p);
        }
    }
}

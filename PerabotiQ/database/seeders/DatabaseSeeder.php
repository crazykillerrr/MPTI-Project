<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin Account
        User::factory()->create([
            'name' => 'Admin PerabotiQ',
            'email' => 'admin@perabotiq.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Customer Account
        User::factory()->create([
            'name' => 'Akun Testing PerabotiQ',
            'email' => 'testing@perabotiq.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
        ]);

        // Products
        $products = [
            // Ruang Tamu
            ['name' => 'KIVIK Sofa', 'description' => 'Sofa 3 dudukan yang sangat nyaman.', 'price' => 4500000, 'stock' => 15, 'category' => 'Ruang Tamu', 'image' => 'assets/img/KIVIK.png'],
            ['name' => 'POANG Armchair', 'description' => 'Kursi santai berdesain klasik.', 'price' => 1200000, 'stock' => 25, 'category' => 'Ruang Tamu', 'image' => 'assets/img/POANG.png'],
            ['name' => 'STRANDMON', 'description' => 'Kursi sayap klasik.', 'price' => 2500000, 'stock' => 10, 'category' => 'Ruang Tamu', 'image' => 'assets/img/STRANDMON.png'],
            
            // Kamar Tidur
            ['name' => 'MALM Bed', 'description' => 'Rangka tempat tidur tinggi.', 'price' => 3200000, 'stock' => 8, 'category' => 'Kamar Tidur', 'image' => 'assets/img/MALM.png'],
            ['name' => 'HAUGA', 'description' => 'Lemari pakaian pintu geser.', 'price' => 2800000, 'stock' => 12, 'category' => 'Kamar Tidur', 'image' => 'assets/img/HAUGA.png'],
            ['name' => 'TARVA', 'description' => 'Rangka tempat tidur pinus solid.', 'price' => 1900000, 'stock' => 20, 'category' => 'Kamar Tidur', 'image' => 'assets/img/TARVA.png'],
            
            // Ruang Makan
            ['name' => 'EKEDALEN Table', 'description' => 'Meja makan dapat dipanjangkan.', 'price' => 3500000, 'stock' => 5, 'category' => 'Ruang Makan', 'image' => 'assets/img/EKEDALEN.png'],
            ['name' => 'NORDEN', 'description' => 'Meja lipat berbahan kayu solid.', 'price' => 2100000, 'stock' => 10, 'category' => 'Ruang Makan', 'image' => 'assets/img/NORDEN.png'],
            ['name' => 'PINNTORP', 'description' => 'Meja kayu sederhana namun kokoh.', 'price' => 1800000, 'stock' => 18, 'category' => 'Ruang Makan', 'image' => 'assets/img/PINNTORP.png'],
            
            // Ruang Kerja
            ['name' => 'MICKE Desk', 'description' => 'Meja kerja dengan penyimpanan.', 'price' => 1400000, 'stock' => 30, 'category' => 'Ruang Kerja', 'image' => 'assets/img/MICKE.png'],
            ['name' => 'FLINTAN', 'description' => 'Kursi kantor putar yang ergonomis.', 'price' => 999000, 'stock' => 45, 'category' => 'Ruang Kerja', 'image' => 'assets/img/FLINTAN.png'],
            ['name' => 'TROTTEN', 'description' => 'Meja kerja fleksibel.', 'price' => 1750000, 'stock' => 12, 'category' => 'Ruang Kerja', 'image' => 'assets/img/TROTTEN.png'],
            
            // Kamar Mandi
            ['name' => 'BROGRUND', 'description' => 'Set shower dengan pengatur suhu.', 'price' => 1100000, 'stock' => 20, 'category' => 'Kamar Mandi', 'image' => 'assets/img/BROGRUND.png'],
            ['name' => 'TVALLEN', 'description' => 'Wastafel minimalis untuk ruang kecil.', 'price' => 1600000, 'stock' => 15, 'category' => 'Kamar Mandi', 'image' => 'assets/img/TVALLEN.png'],
            ['name' => 'VALLAMOSSE', 'description' => 'Shower set lengkap dengan tiang.', 'price' => 850000, 'stock' => 22, 'category' => 'Kamar Mandi', 'image' => 'assets/img/VALLAMOSSE.png'],
            
            // Aksesoris
            ['name' => 'BILLY Bookcase', 'description' => 'Rak buku serbaguna.', 'price' => 950000, 'stock' => 50, 'category' => 'Aksesoris', 'image' => 'assets/img/BILLY.png'],
            ['name' => 'FROJDA', 'description' => 'Hiasan meja bernuansa modern.', 'price' => 150000, 'stock' => 100, 'category' => 'Aksesoris', 'image' => 'assets/img/FROJDA.png'],
            ['name' => 'FONSTERBLAD', 'description' => 'Tanaman hias dalam pot.', 'price' => 85000, 'stock' => 150, 'category' => 'Aksesoris', 'image' => 'assets/img/FONSTERBLAD.png'],
        ];

        foreach ($products as $p) {
            Product::create($p);
        }
    }
}

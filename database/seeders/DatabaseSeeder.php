<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Toko;
use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        // Create member user
        User::factory()->create([
            'name' => 'Member',
            'email' => 'member@example.com',
            'role' => 'member',
        ]);



        // Create categories
        $categories = [
            ['nama_kategori' => 'Buku & Alat Tulis'],
            ['nama_kategori' => 'Pakaian Sekolah'],
            ['nama_kategori' => 'Tas & Ransel'],
            ['nama_kategori' => 'Alat Olahraga'],
            ['nama_kategori' => 'Makanan & Minuman'],
        ];

        foreach ($categories as $category) {
            Kategori::create($category);
        }

        // Create stores
        $stores = [
            [
                'nama_toko' => 'Toko Buku Cerdas',
                'deskripsi' => 'Toko buku dan alat tulis terlengkap untuk siswa',
                'kontak_toko' => '081234567890',
                'alamat' => 'Jl. Pendidikan No. 123',
                'id_user' => 2,
            ],
            [
                'nama_toko' => 'Fashion Siswa',
                'deskripsi' => 'Pakaian dan aksesoris sekolah modern',
                'kontak_toko' => '081234567891',
                'alamat' => 'Jl. Sekolah No. 456',
                'id_user' => 2,
            ],
        ];

        foreach ($stores as $store) {
            Toko::create($store);
        }

        // Create products
        $products = [
            [
                'nama_produk' => 'Buku Tulis Sidu 38 Lembar',
                'deskripsi' => 'Buku tulis berkualitas tinggi untuk sekolah',
                'harga' => 5000,
                'stok' => 100,
                'tanggal_upload' => now()->toDateString(),
                'id_kategori' => 1,
                'id_toko' => 1,
            ],
            [
                'nama_produk' => 'Seragam Sekolah Putih',
                'deskripsi' => 'Seragam sekolah berkualitas dengan bahan nyaman',
                'harga' => 75000,
                'stok' => 50,
                'tanggal_upload' => now()->toDateString(),
                'id_kategori' => 2,
                'id_toko' => 2,
            ],
            [
                'nama_produk' => 'Tas Ransel Anti Air',
                'deskripsi' => 'Tas ransel tahan air dengan desain modern',
                'harga' => 125000,
                'stok' => 30,
                'tanggal_upload' => now()->toDateString(),
                'id_kategori' => 3,
                'id_toko' => 2,
            ],

            [
                'nama_produk' => 'Pensil 2B Faber-Castell',
                'deskripsi' => 'Pensil berkualitas untuk menulis dan menggambar',
                'harga' => 3000,
                'stok' => 200,
                'tanggal_upload' => now()->toDateString(),
                'id_kategori' => 1,
                'id_toko' => 1,
            ],
            [
                'nama_produk' => 'Kaos Olahraga',
                'deskripsi' => 'Kaos olahraga dengan bahan breathable',
                'harga' => 45000,
                'stok' => 75,
                'tanggal_upload' => now()->toDateString(),
                'id_kategori' => 2,
                'id_toko' => 2,
            ],
        ];

        foreach ($products as $product) {
            Produk::create($product);
        }
    }
}

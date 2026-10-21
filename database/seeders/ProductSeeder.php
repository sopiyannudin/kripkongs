<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'nama' => 'Kripkongs Balado',
                'deskripsi' => 'Keripik singkong renyah dengan bumbu balado yang pedas, manis, dan gurih.',
                'harga' => 15000,
                'kategori' => 'Spicy Savory',
                'varian' => 'Balado',
                'gambar' => 'images\balado.jpg',
            ],
            [
                'nama' => 'Kripkongs BBQ',
                'deskripsi' => 'Keripik singkong renyah dengan perpaduan rasa gurih dan aroma barbeque yang khas.',
                'harga' => 15000,
                'kategori' => 'Savory Salty',
                'varian' => 'Barbeque',
                'gambar' => 'images\barbecue.jpg',
            ],
            [
                'nama' => 'Kripkongs Keju',
                'deskripsi' => 'Keripik singkong renyah dengan bumbu keju yang gurih dan lembut.',
                'harga' => 15000,
                'kategori' => 'Savory Salty',
                'varian' => 'Keju',
                'gambar' => 'images\keju.jpg',
            ],
            [
                'nama' => 'Kripkongs Jagung Bakar',
                'deskripsi' => 'Keripik singkong renyah dengan bumbu jagung bakar yang gurih dan sedikit manis.',
                'harga' => 13000,
                'kategori' => 'Sweet Savory',
                'varian' => 'Jagung Bakar',
                'gambar' => 'images\jagung_bakar.jpg',
            ],
            [
                'nama' => 'Kripkongs Daun Jeruk',
                'deskripsi' => 'Keripik singkong dengan sensasi pedas dan aroma daun jeruk yang segar.',
                'harga' => 15000,
                'kategori' => 'Spicy Savory',
                'varian' => 'Pedas Daun Jeruk',
                'gambar' => 'images\daun_jeruk.jpg',
            ],
            [
                'nama' => 'Kripkongs Rumput Laut',
                'deskripsi' => 'Keripik singkong renyah dengan cita rasa rumput laut yang gurih dan sedikit asin.',
                'harga' => 13000,
                'kategori' => 'Savory Salty',
                'varian' => 'Rumput Laut',
                'gambar' => 'images\rumput_laut.jpg',
            ],
            [
                'nama' => 'Kripkongs Ayam Bawang',
                'deskripsi' => 'Keripik singkong dengan perpaduan rasa ayam yang gurih dan aroma bawang yang sedap.',
                'harga' => 13000,
                'kategori' => 'Savory Salty',
                'varian' => 'Ayam Bawang',
                'gambar' => 'images\ayam_bawang.jpg',
            ],
            [
                'nama' => 'Kripkongs Sambal Matah',
                'deskripsi' => 'Keripik singkong dengan cita rasa pedas serta aroma bawang dan rempah khas sambal matah.',
                'harga' => 16000,
                'kategori' => 'Spicy Savory',
                'varian' => 'Sambal Matah',
                'gambar' => 'images\sambal_matah.jpg',
            ],
            [
                'nama' => 'Kripkongs Cokelat',
                'deskripsi' => 'Keripik singkong renyah dengan balutan cokelat manis yang cocok untuk camilan unik.',
                'harga' => 17000,
                'kategori' => 'Sweet',
                'varian' => 'Cokelat',
                'gambar' => 'images\coklat.jpg',
            ],
            [
                'nama' => 'Kripkongs Jagung Manis',
                'deskripsi' => 'Keripik singkong renyah dengan bumbu jagung manis yang gurih dan ringan.',
                'harga' => 13000,
                'kategori' => 'Sweet Savory',
                'varian' => 'Jagung Manis',
                'gambar' => 'images\jagung_manis.jpg',
            ],
            [
                'nama' => 'Kripkongs Sapi Panggang',
                'deskripsi' => 'Keripik singkong renyah dengan bumbu sapi panggang yang gurih dan aroma rempah yang khas.',
                'harga' => 15000,
                'kategori' => 'Savory Salty',
                'varian' => 'Sapi Panggang',
                'gambar' => 'images\Sapi_Panggang.jpg',
            ],
            [
                'nama' => 'Kripkongs Udang Balado',
                'deskripsi' => 'Keripik singkong renyah dengan bumbu udang balado yang gurih, pedas, dan kaya rempah.',
                'harga' => 15000,
                'kategori' => 'Spicy Savory',
                'varian' => 'Udang Balado',
                'gambar' => 'images\Udang_balado.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['nama' => $product['nama']],
                $product
            );
        }
    }
}
;

<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'produk' => 'Kopi Hitam',
                'stok' => 100,
                'harga' => 15000,
            ],
            [
                'produk' => 'Teh Hijau',
                'stok' => 80,
                'harga' => 12000,
            ],
            [
                'produk' => 'Coklat Panas',
                'stok' => 50,
                'harga' => 18000,
            ],
            [
                'produk' => 'Jus Jeruk',
                'stok' => 120,
                'harga' => 14000,
            ],
            [
                'produk' => 'Es Krim Coklat',
                'stok' => 150,
                'harga' => 22000,
            ],
            [
                'produk' => 'Es Teh Manis',
                'stok' => 130,
                'harga' => 10000,
            ],
            [
                'produk' => 'Lemon Tea',
                'stok' => 90,
                'harga' => 11000,
            ],
            [
                'produk' => 'Minuman Soda',
                'stok' => 200,
                'harga' => 7000,
            ],
            [
                'produk' => 'Milkshake Stroberi',
                'stok' => 60,
                'harga' => 25000,
            ],
            [
                'produk' => 'Hot Chocolate',
                'stok' => 80,
                'harga' => 19000,
            ],
            [
                'produk' => 'Kopi Susu',
                'stok' => 150,
                'harga' => 16000,
            ],
            [
                'produk' => 'Cappuccino',
                'stok' => 75,
                'harga' => 17000,
            ],
            [
                'produk' => 'Latte',
                'stok' => 110,
                'harga' => 18000,
            ],
            [
                'produk' => 'Espresso',
                'stok' => 50,
                'harga' => 14000,
            ],
            [
                'produk' => 'Americano',
                'stok' => 60,
                'harga' => 15000,
            ],
            [
                'produk' => 'Macchiato',
                'stok' => 40,
                'harga' => 16000,
            ],
            [
                'produk' => 'Affogato',
                'stok' => 30,
                'harga' => 20000,
            ],
            [
                'produk' => 'Mocha',
                'stok' => 90,
                'harga' => 21000,
            ],
            [
                'produk' => 'Kopi Arabika',
                'stok' => 120,
                'harga' => 23000,
            ],
            [
                'produk' => 'Kopi Robusta',
                'stok' => 140,
                'harga' => 14000,
            ],
            [
                'produk' => 'Teh Chamomile',
                'stok' => 80,
                'harga' => 13000,
            ],
            [
                'produk' => 'Teh Mint',
                'stok' => 70,
                'harga' => 14000,
            ],
            [
                'produk' => 'Teh Blackcurrant',
                'stok' => 60,
                'harga' => 15000,
            ],
            [
                'produk' => 'Jus Alpukat',
                'stok' => 90,
                'harga' => 20000,
            ],
            [
                'produk' => 'Jus Mangga',
                'stok' => 100,
                'harga' => 15000,
            ],
            [
                'produk' => 'Jus Jambu',
                'stok' => 110,
                'harga' => 14000,
            ],
            [
                'produk' => 'Jus Semangka',
                'stok' => 120,
                'harga' => 12000,
            ],
        ];


        foreach ($data as $item) {
            Produk::create($item);
        }
    }
}

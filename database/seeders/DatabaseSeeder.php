<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kategori;
use App\Models\Meja;
use App\Models\MetodePembayaran;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->seedMeja();
        $this->seedMetodePembayaran();
        $this->seedKategoriDanMenu();
    }

    private function seedMetodePembayaran() {
        $metode_pembayaran = [
            'Cash', 'Dana', 'Ovo', 'Shopee Pay', 'M-Banking'
        ];

        foreach ($metode_pembayaran as $metode) {
            MetodePembayaran::create([
                'metodePembayaran' => $metode
            ]);
        }
    }

    private function seedMeja()
    {
        $mejaCodes = [
            'A' => ['01', '02', '03'],
            'B' => ['01', '02', '03'],
            'C' => ['01', '02', '03', '04'],
            'D' => ['01', '02', '00']
        ];

        foreach ($mejaCodes as $section => $numbers) {
            foreach ($numbers as $number) {
                Meja::create([
                    "kodeMeja" => $section . $number,
                ]);
            }
        }
    }

    private function seedKategoriDanMenu()
    {
        $kategoris = [
            [
                'namaKategori' => 'Minuman',
                'menus' => [
                    [
                        'namaMenu' => 'Coffee Latte',
                        'status' => 'Waiting List',
                        'harga' => 14000,
                        'stok' => 20,
                        'foto' => 'foto-Coffee Latte.jpg',
                    ],
                    [
                        'namaMenu' => 'Es Lemon Tea',
                        'status' => 'Ready',
                        'harga' => 8000,
                        'stok' => 5,
                        'foto' => 'foto-Es Lemon Tea.jpg',
                    ],
                    [
                        'namaMenu' => 'Coffee Tubruk',
                        'status' => 'Waiting List',
                        'harga' => 7000,
                        'stok' => 6,
                        'foto' => 'foto-Coffee Tubruk.jpg',
                    ],
                    [
                        'namaMenu' => 'Jus Jeruk',
                        'status' => 'Ready',
                        'harga' => 7000,
                        'stok' => 12,
                        'foto' => 'foto-Jus Jeruk.jpg',
                    ],
                    [
                        'namaMenu' => 'Jus Alpukat',
                        'status' => 'Ready',
                        'harga' => 10000,
                        'stok' => 10,
                        'foto' => 'foto-Jus Alpukat.png',
                    ],
                ]
            ],
            [
                'namaKategori' => 'Non Coffee',
                'menus' => []
            ],
            [
                'namaKategori' => 'Traditional Coffee',
                'menus' => []
            ],
            [
                'namaKategori' => 'Snack',
                'menus' => []
            ],
            [
                'namaKategori' => 'Menu Utama',
                'menus' => [
                    [
                        'namaMenu' => 'Kentang Goreng',
                        'status' => 'Ready',
                        'harga' => 10000,
                        'stok' => 12,
                        'foto' => 'foto-Kentang Goreng.jpg',
                    ],
                    [
                        'namaMenu' => 'Sandwich',
                        'status' => 'Ready',
                        'harga' => 10000,
                        'stok' => 15,
                        'foto' => 'foto-Sandwich.jpg',
                    ],
                    [
                        'namaMenu' => 'Nasi Goreng',
                        'status' => 'Ready',
                        'harga' => 10000,
                        'stok' => 9,
                        'foto' => 'foto-Nasi Goreng.png',
                    ],
                    [
                        'namaMenu' => 'Nasi Ayam',
                        'status' => 'Ready',
                        'harga' => 15000,
                        'stok' => 10,
                        'foto' => 'foto-Nasi Ayam.png',
                    ],
                    [
                        'namaMenu' => 'Nasi Telur',
                        'status' => 'Ready',
                        'harga' => 10000,
                        'stok' => 30,
                        'foto' => 'foto-Nasi Telur.png',
                    ],
                ]
            ]
        ];

        foreach ($kategoris as $kategoriData) {
            // Create the category
            $kategori = Kategori::create([
                'namaKategori' => $kategoriData['namaKategori']
            ]);

            // Create menus for this category
            foreach ($kategoriData['menus'] as $menuData) {
                $kategori->menu()->create($menuData);
            }
        }
    }
}

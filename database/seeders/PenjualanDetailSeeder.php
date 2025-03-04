<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) { // Loop untuk 10 transaksi
            for ($j = 1; $j <= 3; $j++) { // 3 barang untuk setiap transaksi
                DB::table('t_penjualan_detail')->insert([
                    'penjualan_id' => $i,
                    'barang_id' => rand(1, 10), // Barang acak dari 1-10
                    'harga' => rand(5000, 500000), // Harga acak
                    'jumlah' => rand(1, 5), // Jumlah barang acak
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}

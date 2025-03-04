<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PenjualanSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('t_penjualan')->insert([
                'penjualan_id' => $i, // Set ID dari 1 - 10
                'user_id' => 1, 
                'pembeli' => 'Pembeli ' . $i,
                'penjualan_kode' => 'PJ-' . Str::random(6),
                'penjualan_tanggal' => Carbon::now(),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('m_barang')->insert([
            ['kategori_id' => 1, 'barang_kode' => 'B001', 'barang_nama' => 'TV LED', 'harga_beli' => 2500000, 'harga_jual' => 3000000],
            ['kategori_id' => 1, 'barang_kode' => 'B002', 'barang_nama' => 'Laptop', 'harga_beli' => 6500000, 'harga_jual' => 7000000],
            ['kategori_id' => 2, 'barang_kode' => 'B003', 'barang_nama' => 'Kaos Polos', 'harga_beli' => 40000, 'harga_jual' => 50000],
            ['kategori_id' => 2, 'barang_kode' => 'B004', 'barang_nama' => 'Jaket Hoodie', 'harga_beli' => 120000, 'harga_jual' => 150000],
            ['kategori_id' => 3, 'barang_kode' => 'B005', 'barang_nama' => 'Nasi Goreng', 'harga_beli' => 15000, 'harga_jual' => 20000],
            ['kategori_id' => 3, 'barang_kode' => 'B006', 'barang_nama' => 'Mie Ayam', 'harga_beli' => 10000, 'harga_jual' => 15000],
            ['kategori_id' => 4, 'barang_kode' => 'B007', 'barang_nama' => 'Teh Botol', 'harga_beli' => 4000, 'harga_jual' => 5000],
            ['kategori_id' => 4, 'barang_kode' => 'B008', 'barang_nama' => 'Jus Jeruk', 'harga_beli' => 8000, 'harga_jual' => 10000],
            ['kategori_id' => 5, 'barang_kode' => 'B009', 'barang_nama' => 'Setrika', 'harga_beli' => 200000, 'harga_jual' => 250000],
            ['kategori_id' => 5, 'barang_kode' => 'B010', 'barang_nama' => 'Blender', 'harga_beli' => 250000, 'harga_jual' => 300000],
        ]);
        
    }
}

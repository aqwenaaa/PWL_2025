<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MBarangSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['barang_id' => 1, 'kategori_id' => 1, 'barang_kode' => 'LAP001', 'barang_nama' => 'Laptop', 'harga_beli' => 5000000, 'harga_jual' => 5500000],
            ['barang_id' => 2, 'kategori_id' => 1, 'barang_kode' => 'SMP002', 'barang_nama' => 'Smartphone', 'harga_beli' => 3000000, 'harga_jual' => 3500000],
            ['barang_id' => 3, 'kategori_id' => 2, 'barang_kode' => 'RT003', 'barang_nama' => 'Roti', 'harga_beli' => 5000, 'harga_jual' => 7000],
            ['barang_id' => 4, 'kategori_id' => 2, 'barang_kode' => 'SS004', 'barang_nama' => 'Susu', 'harga_beli' => 15000, 'harga_jual' => 20000],
            ['barang_id' => 5, 'kategori_id' => 3, 'barang_kode' => 'KS005', 'barang_nama' => 'Kaos', 'harga_beli' => 50000, 'harga_jual' => 75000],
            ['barang_id' => 6, 'kategori_id' => 3, 'barang_kode' => 'SP006', 'barang_nama' => 'Sepatu', 'harga_beli' => 200000, 'harga_jual' => 250000],
            ['barang_id' => 7, 'kategori_id' => 4, 'barang_kode' => 'BM007', 'barang_nama' => 'Ban Motor', 'harga_beli' => 150000, 'harga_jual' => 200000],
            ['barang_id' => 8, 'kategori_id' => 4, 'barang_kode' => 'OL008', 'barang_nama' => 'Oli', 'harga_beli' => 50000, 'harga_jual' => 75000],
            ['barang_id' => 9, 'kategori_id' => 5, 'barang_kode' => 'LP009', 'barang_nama' => 'Lipstik', 'harga_beli' => 20000, 'harga_jual' => 35000],
            ['barang_id' => 10, 'kategori_id' => 5, 'barang_kode' => 'BD010', 'barang_nama' => 'Bedak', 'harga_beli' => 30000, 'harga_jual' => 50000],
        ];

        DB::table('m_barang')->insert($data);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MBarangSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['barang_id' => 1, 'kategori_id' => 1, 'barang_kode' => 'LPT001', 'barang_nama' => 'Laptop', 'harga_beli' => 7000000, 'harga_jual' => 8000000],
            ['barang_id' => 2, 'kategori_id' => 1, 'barang_kode' => 'SMP001', 'barang_nama' => 'Smartphone', 'harga_beli' => 4000000, 'harga_jual' => 4500000],
            ['barang_id' => 3, 'kategori_id' => 2, 'barang_kode' => 'RT001', 'barang_nama' => 'Roti', 'harga_beli' => 5000, 'harga_jual' => 7000],
            ['barang_id' => 4, 'kategori_id' => 2, 'barang_kode' => 'SS001', 'barang_nama' => 'Susu', 'harga_beli' => 15000, 'harga_jual' => 18000],
            ['barang_id' => 5, 'kategori_id' => 3, 'barang_kode' => 'KS001', 'barang_nama' => 'Kaos', 'harga_beli' => 50000, 'harga_jual' => 75000],
            ['barang_id' => 6, 'kategori_id' => 3, 'barang_kode' => 'SPT001', 'barang_nama' => 'Sepatu', 'harga_beli' => 200000, 'harga_jual' => 250000],
            ['barang_id' => 7, 'kategori_id' => 4, 'barang_kode' => 'BM001', 'barang_nama' => 'Ban Motor', 'harga_beli' => 300000, 'harga_jual' => 350000],
            ['barang_id' => 8, 'kategori_id' => 4, 'barang_kode' => 'OL001', 'barang_nama' => 'Oli', 'harga_beli' => 50000, 'harga_jual' => 60000],
            ['barang_id' => 9, 'kategori_id' => 5, 'barang_kode' => 'LPK001', 'barang_nama' => 'Lipstik', 'harga_beli' => 25000, 'harga_jual' => 35000],
            ['barang_id' => 10, 'kategori_id' => 5, 'barang_kode' => 'BDK001', 'barang_nama' => 'Bedak', 'harga_beli' => 30000, 'harga_jual' => 40000],
        ];

        DB::table('m_barang')->insert($data);
    }
}

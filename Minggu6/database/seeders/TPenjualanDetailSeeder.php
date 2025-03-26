<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TPenjualanDetailSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['detail_id' => 1, 'penjualan_id' => 1, 'barang_id' => 1, 'harga' => 8000000, 'jumlah' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['detail_id' => 2, 'penjualan_id' => 1, 'barang_id' => 2, 'harga' => 5000000, 'jumlah' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['detail_id' => 3, 'penjualan_id' => 2, 'barang_id' => 3, 'harga' => 20000, 'jumlah' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['detail_id' => 4, 'penjualan_id' => 2, 'barang_id' => 4, 'harga' => 15000, 'jumlah' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['detail_id' => 5, 'penjualan_id' => 3, 'barang_id' => 5, 'harga' => 100000, 'jumlah' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['detail_id' => 6, 'penjualan_id' => 4, 'barang_id' => 6, 'harga' => 300000, 'jumlah' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['detail_id' => 7, 'penjualan_id' => 5, 'barang_id' => 7, 'harga' => 250000, 'jumlah' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['detail_id' => 8, 'penjualan_id' => 6, 'barang_id' => 8, 'harga' => 50000, 'jumlah' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['detail_id' => 9, 'penjualan_id' => 7, 'barang_id' => 9, 'harga' => 75000, 'jumlah' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['detail_id' => 10, 'penjualan_id' => 8, 'barang_id' => 10, 'harga' => 120000, 'jumlah' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('t_penjualan_detail')->insert($data);
    }
}

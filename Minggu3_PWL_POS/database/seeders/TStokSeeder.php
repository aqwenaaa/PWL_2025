<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TStokSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['barang_id' => 1, 'user_id' => 1, 'stok_tanggal' => Carbon::now(), 'stok_jumlah' => 50], //untuk mengisi tanggal stok secara dinamis, stok jumlah merupakan stok yg ditambahkan
            ['barang_id' => 2, 'user_id' => 2, 'stok_tanggal' => Carbon::now()->subDays(1), 'stok_jumlah' => 30], //untuk memberikan variasi tanggal masuk stok agar tidak semuanya memiliki waktu yang sama.
            ['barang_id' => 3, 'user_id' => 3, 'stok_tanggal' => Carbon::now()->subDays(2), 'stok_jumlah' => 100],
            ['barang_id' => 4, 'user_id' => 1, 'stok_tanggal' => Carbon::now()->subDays(3), 'stok_jumlah' => 20],
            ['barang_id' => 5, 'user_id' => 2, 'stok_tanggal' => Carbon::now()->subDays(4), 'stok_jumlah' => 75],
            ['barang_id' => 6, 'user_id' => 3, 'stok_tanggal' => Carbon::now()->subDays(5), 'stok_jumlah' => 40],
            ['barang_id' => 7, 'user_id' => 1, 'stok_tanggal' => Carbon::now()->subDays(6), 'stok_jumlah' => 10],
            ['barang_id' => 8, 'user_id' => 2, 'stok_tanggal' => Carbon::now()->subDays(7), 'stok_jumlah' => 25],
            ['barang_id' => 9, 'user_id' => 3, 'stok_tanggal' => Carbon::now()->subDays(8), 'stok_jumlah' => 60],
            ['barang_id' => 10, 'user_id' => 1, 'stok_tanggal' => Carbon::now()->subDays(9), 'stok_jumlah' => 15],
        ];

        DB::table('t_stok')->insert($data); //barang_id dan user_id mengacu pada data yang sudah ada di m_barang dan m_user
    }
}

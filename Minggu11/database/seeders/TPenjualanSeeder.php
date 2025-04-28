<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TPenjualanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['user_id' => 1, 'pembeli' => 'Andi', 'penjualan_kode' => 'TRX001', 'penjualan_tanggal' => Carbon::now()],
            ['user_id' => 2, 'pembeli' => 'Budi', 'penjualan_kode' => 'TRX002', 'penjualan_tanggal' => Carbon::now()->subDays(1)],
            ['user_id' => 3, 'pembeli' => 'Citra', 'penjualan_kode' => 'TRX003', 'penjualan_tanggal' => Carbon::now()->subDays(2)],
            ['user_id' => 1, 'pembeli' => 'Dina', 'penjualan_kode' => 'TRX004', 'penjualan_tanggal' => Carbon::now()->subDays(3)],
            ['user_id' => 2, 'pembeli' => 'Eko', 'penjualan_kode' => 'TRX005', 'penjualan_tanggal' => Carbon::now()->subDays(4)],
            ['user_id' => 3, 'pembeli' => 'Faisal', 'penjualan_kode' => 'TRX006', 'penjualan_tanggal' => Carbon::now()->subDays(5)],
            ['user_id' => 1, 'pembeli' => 'Gita', 'penjualan_kode' => 'TRX007', 'penjualan_tanggal' => Carbon::now()->subDays(6)],
            ['user_id' => 2, 'pembeli' => 'Hadi', 'penjualan_kode' => 'TRX008', 'penjualan_tanggal' => Carbon::now()->subDays(7)],
            ['user_id' => 3, 'pembeli' => 'Indah', 'penjualan_kode' => 'TRX009', 'penjualan_tanggal' => Carbon::now()->subDays(8)],
            ['user_id' => 1, 'pembeli' => 'Joko', 'penjualan_kode' => 'TRX010', 'penjualan_tanggal' => Carbon::now()->subDays(9)],
        ];

        DB::table('t_penjualan')->insert($data);
    }
}

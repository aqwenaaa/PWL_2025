<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StokSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'stok_id' => $i,
                'barang_id' => $i,
                'user_id' => 3, // Staff
                'stok_tanggal' => Carbon::now()->subDays(rand(1, 30))->toDateTimeString(),
                'stok_jumlah' => rand(10, 100),
            ];
        }

        DB::table('t_stok')->insert($data);
    }
}
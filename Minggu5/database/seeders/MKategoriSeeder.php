<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MKategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kategori_id' => 1, 'kategori_kode' => 'ELC', 'kategori_nama' => 'Elektronik'],
            ['kategori_id' => 2, 'kategori_kode' => 'FNB', 'kategori_nama' => 'Makanan & Minuman'],
            ['kategori_id' => 3, 'kategori_kode' => 'FAS', 'kategori_nama' => 'Fashion'],
            ['kategori_id' => 4, 'kategori_kode' => 'OTM', 'kategori_nama' => 'Otomotif'],
            ['kategori_id' => 5, 'kategori_kode' => 'KSM', 'kategori_nama' => 'Kosmetik'],
        ];
        DB::table('m_kategori')->insert($data);
    }
}

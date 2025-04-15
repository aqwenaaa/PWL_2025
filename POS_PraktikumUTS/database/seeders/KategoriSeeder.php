<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $kategori = [
            ['kategori_kode' => 'OTO', 'kategori_nama' => 'Otomotif'],
        ];

        DB::table('m_kategori')->insert($kategori);
    }
}
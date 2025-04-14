<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('m_supplier')->insert([
            [
                'supplier_kode' => 'SUP001',
                'supplier_nama' => 'PT Sumber Jaya', 
                'supplier_alamat' => 'Jl. Merdeka No. 123, Jakarta', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_kode' => 'SUP002',
                'supplier_nama' => 'CV Maju Bersama', 
                'supplier_alamat' => 'Jl. Kenanga No. 45, Surabaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_kode' => 'SUP003',
                'supplier_nama' => 'UD Sejahtera',
                'supplier_alamat' => 'Jl. Mawar No. 7, Bandung', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

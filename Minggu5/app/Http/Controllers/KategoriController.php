<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index() 
    {
        // $data = [
        //     'kategori_id' => 2,
        //     'kategori_kode' => 'FNB',
        //     'kategori_nama' => 'Makanan & Minuman',
        //     'created_at' => now(),
        // ];
        // DB::table('m_kategori')->insert($data);
        // return 'Insert data baru berhasil';

        // $row = DB::table('m_kategori')->where('kategori_kode', 'FNB')->update(['kategori_nama' => 'Makanan & Minuman']);
        // return 'Update data berhasil. Jumlah data yang diupdate: '.$row.' baris';
        
        // $row = DB::table('m_kategori')->where('kategori_kode', 'FNB')->delete();
        // return 'Delete data berhasil. Jumlah data yang dihapus: '.$row.' baris';
        
        $data = DB::table('m_kategori')->get();
        return view('kategori', ['data' => $data]);
        }
    }


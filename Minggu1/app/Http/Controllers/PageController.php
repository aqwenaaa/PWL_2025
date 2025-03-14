<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Menampilkan "Selamat Datang"
    public function index()
    {
        return 'Selamat Datang';
    }

    // Menampilkan Nama dan NIM
    public function about()
    {
        return 'Nama: Aqueena Regita <br> NIM: 12345678';
    }

    // Menampilkan halaman artikel dengan id dinamis
    public function articles($id)
    {
        return "Halaman Artikel dengan ID: " . $id;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function index()
    {
        return "Menampilkan daftar foto";
    }

    public function create()
    {
        return "Menampilkan form upload foto";
    }

    public function store(Request $request)
    {
        return "Menyimpan foto ke database";
    }

    public function show($id)
    {
        return "Menampilkan detail foto dengan ID: " . $id;
    }

    public function edit($id)
    {
        return "Menampilkan form edit foto dengan ID: " . $id;
    }

    public function update(Request $request, $id)
    {
        return "Mengupdate foto dengan ID: " . $id;
    }

    public function destroy($id)
    {
        return "Menghapus foto dengan ID: " . $id;
    }
}

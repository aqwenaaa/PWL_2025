<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BarangController extends Controller
{
    public function index()
    {
        return BarangModel::all();
    }
    public function store(Request $request)
    {
        $params = $request->all();

        if($request->hasFile('image')){
            unset($params['image']);
            $file = $request->file('image');
            $image = $file->getClientOriginalName();
            $fileName = md5($image . Str::random(10) . time()).'.'.$file->getClientOriginalExtension();

            $file->storeAs('public/posts', $fileName);
            $params['image'] = $fileName;
        }

        $barang = BarangModel::create($params);
        return response()->json($barang, 201);
    }

    public function show($barang)
    {
        return BarangModel::find($barang);
    }

    public function update(Request $request, $barang)
    {
        $data = BarangModel::find($barang);

        $params = $request->all();

        if($request->hasFile('image')){
            unset($params['image']);

            $file = $request->file('image');
            $image = $file->getClientOriginalName();
            $fileName = md5($image . Str::random(10) . time()).'.'.$file->getClientOriginalExtension();

            $file->storeAs('public/posts', $fileName);
            $params['image'] = $fileName;
        }

        $data->update($params);
        return BarangModel::find($barang);
    }

    public function destroy($barang)
    {
        $data = BarangModel::find($barang);
        $data->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data terhapus',
        ]);
    }
}
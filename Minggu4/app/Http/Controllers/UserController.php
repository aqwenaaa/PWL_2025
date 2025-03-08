<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller {
    public function index()
    {
        $user = UserModel::with('level')->get();
        return view('user', ['data' => $user]);
    }

    public function tambah()
    {
        return view('user_tambah');
    }

    public function tambah_simpan(Request $request)
    {
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'level_id' => $request->level_id,
            ]);
            return redirect('/user');
    }

    public function ubah($id)
    {
        $data = UserModel::find($id);
        return view('user_ubah', ['data' => $data]);
    }
    
    public function ubah_simpan(Request $request, $id)
    {
        $user = UserModel::find($id);
        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->password = Hash::make($request->password);
        $user->level_id = $request->level_id;
        $user->save();
        return redirect('/user');
    }

    public function hapus($id)
    {
        $user = UserModel::find($id);
        $user->delete();
        return redirect('/user');
    }
         //find : karena ada satu record di database yg id nya 1, maka akan menampilkan record yg id nya 1
        //first : karena kita ingin menampilkan record pertama yg memiliki level_id 1, maka akan menampilkan record yg id nya 1
        //firstWhere : karena kita ingin menampilkan record pertama yg memiliki level_id 1, maka akan menampilkan record yg id nya 1
        //findOr : karena ada satu record di database yg id nya 1, maka akan menampilkan record yg id nya 1, tapi klo gaada hasilnya 404notfound
        //findOrFail : karena ada satu record di database yg id nya 1, maka akan menampilkan record yg id nya 1 dan akan menampilkan error 404notfound
        //firstorcreate : karena ada di database tidak ada usn manager maka akan membuat record baru dengan usn manager, jika ada tidak akan merubah db
        //isdirty : Digunakan untuk mengecek apakah suatu atribut model telah diubah tetapi belum disimpan ke database.
        //wasChanged : Digunakan untuk mengecek apakah suatu atribut model telah diubah.
        //isClean : Digunakan untuk mengecek apakah model tidak memiliki perubahan.


        
    
}

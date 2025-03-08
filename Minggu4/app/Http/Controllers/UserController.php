<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    

    public function index()
    {
        $user = UserModel::where('username', 'manager9')->firstorfail();
        //find : karena ada satu record di database yg id nya 1, maka akan menampilkan record yg id nya 1
        //first : karena kita ingin menampilkan record pertama yg memiliki level_id 1, maka akan menampilkan record yg id nya 1
        //firstWhere : karena kita ingin menampilkan record pertama yg memiliki level_id 1, maka akan menampilkan record yg id nya 1
        //findOr : karena ada satu record di database yg id nya 1, maka akan menampilkan record yg id nya 1, tapi klo gaada hasilnya 404notfound
        //findOrFail : karena ada satu record di database yg id nya 1, maka akan menampilkan record yg id nya 1 dan akan menampilkan error 404notfound
        

        return view('user', ['data'=> $user]);
    }
}

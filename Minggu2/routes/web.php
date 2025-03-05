<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::get('/hello', function () { return 'Hello World';
});

Route::get('/world', function () { return 'World';
});

Route::get('/user/{name}', function ($name) { return 'Nama saya '.$name;
});

Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
    return 'Pos ke-'.$postId." Komentar ke-: ".$commentId;
    });

Route::get('/user/{name?}', function ($name=null) {
return 'Nama saya '.$name;
});

Route::get('/user/{name?}', function ($name='John') { return 'Nama saya '.$name;
});


Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\UserProfileController;

Route::get('/user/profile', function () {
    //
})->name('profile');

Route::get('/user/profile', 
    [UserProfileController::class, 'show'])->name('profile');

//Generating URL
//$url = route('profile');
//Generating Redirects
// return redirect()->route('profile');

Route::get('/user/{name?}', function ($name='John') { return 'Nama saya '.$name;
});

Route::view('/welcome', 'welcome', ['name' => 'Aqueena']);

use App\Http\Controllers\WelcomeController;

Route::get('/hello', [WelcomeController::class, 'hello']);

use App\Http\Controllers\PageController;
// Route untuk halaman utama
Route::get('/', [PageController::class, 'index']);

// Route untuk halaman about
Route::get('/about', [PageController::class, 'about']);

// Route untuk halaman artikel dengan ID dinamis
Route::get('/articles/{id}', [PageController::class, 'articles']);

use App\Http\Controllers\PhotoController;
// Membuat semua route CRUD untuk PhotoController
Route::resource('photos', PhotoController::class);

Route::get('/greeting', function () {
    return view('hello', ['name' => 'Aqueena']);
});

Route::get('/greeting', function () {
    return view('blog.hello', ['name' => 'Aqueena']);
});

Route::get('/greeting', [WelcomeController::class, 'greeting']);


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

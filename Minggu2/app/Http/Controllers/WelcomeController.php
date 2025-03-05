<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function hello()
    {
        return 'Hello World';
    }

    public function greeting()
    {
        return view('blog.hello')
        -> with('name', 'Aqueena')
        -> with('occupation', 'Astronaut'); //mengirim data ke view occupation="astronaut"
    }
}

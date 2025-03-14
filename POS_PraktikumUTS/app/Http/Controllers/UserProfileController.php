<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show()
    {
        // Generating URL
        $url = route('profile');
        
        // Generating Redirects
        return redirect()->route('profile');
        return $url;
    }
}

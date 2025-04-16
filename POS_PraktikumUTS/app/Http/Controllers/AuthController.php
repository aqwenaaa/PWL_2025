<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Display the login page or redirect to home if already authenticated
    public function login()
    {
        // Check if user is already logged in
        if (Auth::check()) {
            return redirect('/');
        }

        // Return the login view
        return view('auth.login');
    }

    // Handle login form submission
    public function postlogin(Request $request)
    {
        // Check if the request is AJAX or expects JSON response
        if ($request->ajax() || $request->wantsJson()) {
            // Get username and password from request
            $credentials = $request->only('username', 'password');

            // Attempt to authenticate user
            if (Auth::attempt($credentials)) {
                // Return success response with redirect URL
                return response()->json([
                    'status' => true,
                    'message' => 'Login Berhasil',
                    'redirect' => url('/')
                ]);
            }

            // Return failure response if authentication fails
            return response()->json([
                'status' => false,
                'message' => 'Login Gagal'
            ]);
        }

        // Redirect to login page for non-AJAX requests
        return redirect('login');
    }

    // Log out the authenticated user
    public function logout(Request $request)
    {
        // Log out the user
        Auth::logout();
        // Invalidate the session
        $request->session()->invalidate();
        // Regenerate CSRF token
        $request->session()->regenerateToken();
        // Redirect to login page with a status message
        return redirect('/login')->with('status', 'You have been logged out.');
    }

    // Display the registration page
    public function register()
    {
        // No need to fetch levels as all new users are assigned 'Staff'
        return view('auth.register');
    }

    // Handle registration form submission
    public function postRegister(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:m_user,username', // Ensure username is unique
            'nama' => 'required|string|max:255', // Name is required and max 255 characters
            'password' => 'required|string|min:5|confirmed', // Password must be confirmed and at least 5 characters
        ]);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed.',
                'errors' => $validator->errors(),
            ]);
        }

        // Fetch the 'Staff' level ID
        $staffLevel = LevelModel::where('level_nama', 'Staff')->first();
        if (!$staffLevel) {
            return response()->json([
                'status' => false,
                'message' => 'Staff role not found in the system.',
            ]);
        }

        // Create a new user with 'Staff' role
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password), // Hash the password
            'level_id' => $staffLevel->level_id // Assign Staff role
        ]);

        // Return success response with redirect to login page
        return response()->json([
            'status' => true,
            'message' => 'Registration Success.',
            'redirect' => url('/login')
        ]);
    }
}
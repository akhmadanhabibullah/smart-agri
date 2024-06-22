<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Define static email and password
    private $staticEmail = 'user@gmail.com';
    private $staticPassword = 'password123';

    public function index()
    {
        return view('login.index', [ 
            'title' => 'Login',
        ]);
    }

    public function authenticate(Request $request)
    {
        // Validate the input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Check if the provided credentials match the static ones
        if ($credentials['email'] === $this->staticEmail && $credentials['password'] === $this->staticPassword) {
            // Manually log the user in
            session(['authenticated' => true]);
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login failed!');
    }

    public function logout(Request $request)
    {
        // Manually log the user out
        session()->forget('authenticated');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

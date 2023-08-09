<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the login data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the login credentials match the user in the database
        if (auth()->attempt($request->only('email', 'password'))) {
            return redirect()->route('posts.manage');
        }

        // Authentication failed, redirect back to the login page with an error message
        return redirect('/login')->with('error', 'Invalid credentials. Please try again.');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out.');
    }
}

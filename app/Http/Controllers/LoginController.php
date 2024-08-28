<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('author.login'); 
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Validate the credentials
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Query the database for the user
        $user = DB::table('users')->where('email', $credentials['email'])->first();

        // Check if user exists and the password is correct
        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::loginUsingId($user->id);

            // Redirect to the intended page or dashboard
            return redirect()->intended('dashboard');
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        // Auth::logout();
        // return redirect('/');
        
         Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'You have been logged out.');
    }
}

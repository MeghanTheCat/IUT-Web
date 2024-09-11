<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        // called view for this controller
        return view('auth.login');
    }

    // insure login form validated
    public function store(Request $request)
    {
        // datas validation
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // attempted connection with the data provided
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // redirection to home page after connection
            return redirect()->intended('/');
        }

        // if failure return error
        throw ValidationException::withMessages([
            'email' => __('Incorrect informations.'),
        ]);
    }

    // user disconnection
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
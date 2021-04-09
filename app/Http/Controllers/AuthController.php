<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	protected function login()
	{
		return view('login');
	}

    protected function validateLogin(Request $request)
    {
    	$request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if(auth()->guard()->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->route('dashboard');
        }
 
        throw ValidationException::withMessages([
            'username' => ['Username/Password salah.'],
        ]);
    }

    protected function logout()
    {
    	return redirect('/')->with(Auth::logout());
    }
}

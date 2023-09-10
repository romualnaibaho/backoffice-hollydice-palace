<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('pages.auth.login');
    }

    public function doLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|exists:users,email',
            'password' => 'required',
        ]);
    
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
    
        if (\Auth::attempt($credentials, true)) {
            \Auth::user()->update(['last_login' => Carbon::now()]);
    
            return redirect()->route('dashboard');
        }
    
        return redirect()->back();
    }

    public function logout()
    {
        \Auth::logout();

        return redirect()->route('login');
    }
}

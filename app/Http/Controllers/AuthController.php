<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function proses_login(request $request)
    {
        request()->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ]);
        $kredensil = $request->only('username','password');

            if (Auth::attempt($kredensil)) {
                $user = Auth::user();
                if ($user->level == 'admin') {
                    return redirect()->intended('admin');
                }elseif ($user->level == 'kasir') {
                    return redirect()->intended('kasir');
                }elseif ($user->level == 'manager') {
                    return redirect()->intended('manager');
                }
                return redirect()->intended('/');
            }
        return redirect('login');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return Redirect('login');
    }

}

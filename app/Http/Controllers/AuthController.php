<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->users = new User;
    }

    public function index()
    {
        if (session()->has('userLogin')) {
            return redirect()->intended('home');
        }
        return redirect('login');
    }

    /**
     * Get the login email to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'user';
    }

    public function showLoginForm()
    {
        if (session()->has('userLogin')) {
            return redirect()->intended('home');
        }

        return view('auth.login');
    }



    public function proses_login(Request $request)
    {
        request()->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'Username tidak boleh kosong',
                'password.required' => 'Password tidak boleh kosong',
                'username.string' => 'Username harus berupa string',
                'password.string' => 'Password harus berupa string'
            ]);

        $kredensil = $request->only('username','password');

        if (Auth::attempt($kredensil)) {
            $user = Auth::user();
            $request->session()->put('userLogin', $user);
            return redirect()->intended('/dashboard');
        }


        return redirect('login')->withInput()->with('error-login', 'Username atau Password Salah');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        session()->pull('userLogin');
        return redirect('login');
    }
}

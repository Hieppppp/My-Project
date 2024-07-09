<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\Login\LoginRequest;
use App\Http\Requests\Login\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function login(LoginRequest $request)
    {
        $request->validated();
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }
        return back();
    }

    public function register(RegisterRequest $request)
    {
        $request->validated();

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'date_of_birth' => date(now()),
            'phone' => 'null',
            'avatar' => 'null',
        ]);

        $user->assignRole(UserRole::USER);
        Auth::login($user);
        return redirect()->intended('/');

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

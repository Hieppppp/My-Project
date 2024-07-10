<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\Login\LoginRequest;
use App\Http\Requests\Login\RegisterRequest;
use App\Models\User;
use App\Models\VerificationToken;
use App\Services\User\UserServiceInterface;
use Illuminate\Console\View\Components\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Support\Str;

class AuthController extends Controller
{    
    public function __construct(
        public UserServiceInterface $userService
    )
    {
        
    }
    /**
     * showLoginForm
     *
     * @return : Factory|View
     */
    public function showLoginForm(): Factory|View
    {
        return view('auth.login');
    }
    
    /**
     * showRegisterForm
     *
     * @return : Factory|View
     */
    public function showRegisterForm(): Factory|View
    {
        return view('auth.register');
    }
    
    /**
     * login
     *
     * @param  LoginRequest $request
     * @return 
     */
    public function login(LoginRequest $request)
    {
        $request->validated();
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/home');
        }
        return back();
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = $this->userService->register($validated);

        Auth::login($user);

        return redirect('login');
    }

    public function verifyUser(string $token)
    {
        $message = $this->userService->verifyUser($token);

        return redirect()->route('login')->with('sms', $message);
    }
    
    /**
     * logout
     *
     * @return Redirector|RedirectResponse
     */
    public function logout(): Redirector|RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

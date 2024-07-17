<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login\LoginRequest;
use App\Http\Requests\Login\RegisterRequest;
use App\Services\User\UserServiceInterface;
use Illuminate\Console\View\Components\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\ResetsPasswords;


class AuthController extends Controller
{ 
    use SendsPasswordResetEmails, ResetsPasswords {
        
        SendsPasswordResetEmails::broker insteadof ResetsPasswords;
        ResetsPasswords::credentials insteadof SendsPasswordResetEmails;
        SendsPasswordResetEmails::credentials as sendPasswordResetEmailsCredentials;
    }
        
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
     * @return Redirector|RedirectResponse
     */
    public function login(LoginRequest $request): Redirector|RedirectResponse
    {
        $request->validated();
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/home');
        }
        return back();
    }
    
    /**
     * register
     *
     * @param  RegisterRequest $request
     * @return Redirector|RedirectResponse
     */
    public function register(RegisterRequest $request): Redirector|RedirectResponse
    {
        $validated = $request->validated();

        $user = $this->userService->register($validated);

        Auth::login($user);

        return redirect('login');
    }
    
    /**
     * verifyUser
     *
     * @param  string $token
     * @return Redirector|RedirectResponse
     */
    public function verifyUser(string $token): Redirector|RedirectResponse
    {
        $message = $this->userService->verifyUser($token);

        return redirect()->route('login')->with('sms', $message);
    }
    
    /**
     * logout
     *
     * @return Redirector|RedirectResponse
     */
    public function logout(Request $request): Redirector|RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function showLinkRequestForm(): Factory|View
    {
        return view('auth.passwords.email');
    }
    
    /**
     * showResetForm
     *
     * @param  mixed $token
     * @return Factory
     */
    public function showResetForm(string $token): Factory|View
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }
}

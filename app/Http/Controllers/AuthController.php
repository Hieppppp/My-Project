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
            return redirect()->intended('/');
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

    public function verifyUser($token)
    {
        $message = $this->userService->verifyUser($token);

        return redirect()->route('login')->with('sms', $message);
    }
    

    // public function register(RegisterRequest $request)
    // {
    //     $request->validated();
    //     $user = new User();
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->password = Hash::make($request->password);
    //     $user->date_of_birth = date(now());
    //     $user->phone = 'null';
    //     $user->avatar = 'null';
    //     $save = $user->save();

    //     if ($save) 
    //     {
    //         $user->assignRole(UserRole::USER);

    //         $token = base64_encode(Str::random(64));

    //         VerificationToken::create([
    //             'user_type' => UserRole::USER,
    //             'email' => $request->email,
    //             'token' => $token
    //         ]);

    //         $actionLink = route('user.verify', ['token' => $token]);

    //         $data['action_links'] = $actionLink;
    //         $data['name'] = $request->name;
    //         $data['email'] = $request->email;

    //         Mail::send('admin.mail.verify_email', $data, function($message) use ($data) {
    //             $message->to($data['email']);
    //             $message->subject('Verify Your Email');
    //         });

    //         Auth::login($user);

    //         return redirect('login');

    //     }
        
    // }

    // public function verifyUser($token)
    // {
    //     $verifyToken = VerificationToken::where('token', $token)->first();

    //     if ( !is_null($verifyToken) ) {
    //         $user = User::where('email', $verifyToken->email)->first();

    //         if (!$user->verified) {
    //             $user->verified = 1;
    //             $user->save();

    //             return redirect()->route('login')->with('sms', 'Email has been verified');
    //         }
    //         else
    //         {
    //             return redirect()->route('login')->with('sms', 'Email has been created');
    //         }
    //     }
    //     else
    //     {
    //         return redirect()->route('auth.register')->with('sms', 'Invalid Code');
    //     }
    // }
    
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

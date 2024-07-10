<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Console\View\Components\Factory;
use Illuminate\View\View;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;
    
    /**
     * showResetForm
     *
     * @param  string $token
     * @return void
     */
    public function showResetForm(string $token): Factory|View
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }
}

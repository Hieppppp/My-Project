<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Console\View\Components\Factory;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
    
    
    /**
     * showLinkRequestForm
     *
     * @return Factory|View
     */
    public function showLinkRequestForm(): Factory|View
    {
        return view('auth.passwords.email');
    }
}

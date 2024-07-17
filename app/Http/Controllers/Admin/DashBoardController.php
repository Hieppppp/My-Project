<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DashBoardController extends Controller
{
       
    /**
     * changeLanguage
     *
     * @param  mixed $language
     * @return void
     */
    public function changeLanguage($language)
    {
        Session::put('website_language', $language);

        return redirect()->back();
    }
}

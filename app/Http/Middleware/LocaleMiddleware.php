<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Lấy dữ liệu lưu trong Session, không có thì trả về default lấy trong config
        $language = Session::get('website_language', config('app.locale'));

        // Thiết lập ngôn ngữ ứng dụng
        App::setLocale($language);

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function handle(Request $request, Closure $next)
    {
        $language = $request->session()->get('language', null);

        // Якщо мова відсутня в сесії, встановлюємо мову за замовчуванням на основі браузера
        if ($language === null) {
            $locale = $request->getPreferredLanguage(['en', 'uk']);
            App::setLocale($locale);
            Session::put('language', $locale);
        } else {
            App::setLocale($language);
        }

        return $next($request);
    }
}

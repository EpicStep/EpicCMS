<?php

namespace App\Http\Middleware;

use App\Settings;
use Closure;

class Forum
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $settings = Settings::all()->first(); // Получаем все настройки

        if ($settings['forum'] != 1){
            return redirect(route('welcome'));
        }
        return $next($request);
    }
}

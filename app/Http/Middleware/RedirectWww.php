<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * https・wwwリダイレクトに対応するmiddleware
 */
class RedirectWww
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->getHttpHost() === 'snail.site.co.jp') {
            return redirect()->away(env('APP_URL'). $request->getRequestUri(), 301);
        }

        return $next($request);
    }
}
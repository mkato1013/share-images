<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RegenerateToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->method() === 'POST') {
            // 多重送信防止
            $request->session()->regenerateToken();
        }
        return $next($request);
    }
}

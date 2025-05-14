<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsRegistered
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
       if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'ログインしてください。');
        }

        if (!Auth::user()->weightTarget) {
            return redirect()->route('register.step1.form')->with('error', '登録が必要です' );
        }
       
        return $next($request);
    }
}

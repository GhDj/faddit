<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth; // <- import the namespace
class NicknameMiddleware
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
        if(Auth::user() !== null && $request->route()->getUri() !=="logout")
        {
            if(Auth::user()->nickname === "" && $request->route()->getUri() !=="nickname")
            {
                return redirect('nickname');
            }
            elseif (Auth::user()->nickname !== "" && $request->route()->getUri() ==="nickname")
            {
                return redirect('logged');
            }
        }
        return $next($request);
    }
}

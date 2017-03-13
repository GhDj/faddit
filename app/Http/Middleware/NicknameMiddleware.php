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
        if(Auth::user() !== null && $request->route()->uri() !=="logout")
        {
            if(Auth::user()->nickname === "" && $request->route()->uri() !=="nickname")
            {
                return redirect('nickname');
            }
            elseif (Auth::user()->nickname !== "" && $request->route()->uri() ==="nickname")
            {
                return redirect('logged');
            }
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthenticateClient
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
        if(Auth::guard('client')->guest()){
            return redirect('/client/login');
//            exit("你没有登录<a target='_parent' href='/client/login" . "'>请登录</a>");
        }
        return $next($request);
    }
}

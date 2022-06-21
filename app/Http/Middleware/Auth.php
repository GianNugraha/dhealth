<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!empty(session()->get('status'))) {
            return $next($request);
        }
        else
        {
            redirect()->back();
        }
        return redirect(route('login'))->with('error', "you don`t have access !");
        // return $next($request);
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Keuangan
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
        // dd(auth()->check());
        if (auth()->check() === false) {
            return redirect('/login');

        }
        else{
            if (auth()->user()->role === 'Keuangan' || auth()->user()->role === 'Admin'){
                return $next($request);
            }
            else{
                abort(403);
            }
        }

        // if (auth()->check() === true) {
        //     $role = auth()->user()->role;
        //     if ($role === 'Keuangan') {
        //         return $next($request);
        //     }else if ($role === null) {
        //         return '/login';
        //     }
        // }
        // return '/';

    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class Manager
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
        if (auth()->check() === false) {
            return redirect('/login');

        }
        else{
            if (auth()->user()->role === 'Manager'){
                return $next($request);
            }

            else{
                if($next($request) == true) {
                    Alert::error('Mohon Maaf', 'Halaman Tidak Tersedia');
                    return back();
                } else {
                    Alert::error('Mohon Maaf', 'Halaman Tidak Tersedia');
                    return back();
                }
                // dd($next($request));
                // abort(403);
            }
        }
    }
}

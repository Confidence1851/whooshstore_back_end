<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if (Auth::check()) {
            $user = Auth::User();
            if ($user->role != 'Admin') {
                Session::flash('error_msg','Access Denied!.....Admins Only!');
                return redirect('/');
            }
        } else{
            return redirect('/login');
        }
        return $next($request);
    }
}

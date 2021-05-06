<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class checkUser
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

        
    $user = Auth::user();
    // if (!Auth::check()) // This isnt necessary, it should be part of your 'auth' middleware
    //   return redirect('/home');
dd($user);
    if($user->email && $user->email != 'd@d.com')

    return redirect('/home');
        
        return $next($request);
        
    }
}

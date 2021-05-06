<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// add
use Illuminate\Auth\Middleware\Role as Middleware;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     return $next($request);
    // }

    // add
    public function handle($request, Closure $next, String $role) {
        // if (!Auth::check()) // This isnt necessary, it should be part of your 'auth' middleware
        //   return redirect('/home');
    
        $user = Auth::user();

        //if($user->role == $role)
        if(!empty($user->role) && $user->role == $role)
          return $next($request);
    
        return redirect('/home');
      }
}

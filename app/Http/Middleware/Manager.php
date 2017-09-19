<?php

namespace App\Http\Middleware;

use Closure;

//First, we tell Laravel that we want to use the Auth facade:
use Illuminate\Support\Facades\Auth;

class Manager
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


        // Then we use Auth:check() method to check if the user is logged in. If not, then the user is redirected to the login page.
        if(!Auth::check()) {
            return redirect('users/login');
        } else {

            //Otherwise, we use Auth::user() method to retrieve the authenticated user. This way, we can check 
            //if the user has the manager role. If not, the user is redirected back to the home page.
            $user = Auth::user();
            if($user->hasRole('manager','member'))
            {
                return $next($request);
            } else {
                return redirect('/');
            }
        }




        return $next($request);
    }
}

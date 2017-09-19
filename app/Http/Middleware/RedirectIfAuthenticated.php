<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
     
        $fp=fopen('daten.txt', 'w+');
        ob_start();
        print_r($_SERVER);  
        print_r(get_declared_traits());
        fwrite($fp, ob_get_contents());
        ob_end_clean();
        fclose($fp);
        

        if (Auth::guard($guard)->check()) {

            
            return redirect('/home');
        }

        return $next($request);
    }
}

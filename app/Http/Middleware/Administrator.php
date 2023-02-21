<?php

namespace App\Http\Middleware;

use Closure;

class Administrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $user = \Auth::user();
        $role = $user->role;
        if ($role != 'admin') {
            return redirect()->back()->withErrors(notific8(trans('surveys.noaccess')));;
        }
       
        return $next($request);
    }
}

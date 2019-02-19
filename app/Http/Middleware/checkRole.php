<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class checkRole
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
        $guard = Session::get("guard");
        $user = Auth::guard($guard)->user();
        if($user["user_type"] == 2 || $user["user_type"]==3){
            view()->share('gIsAdmin', $user["user_type"] == 2);
            return $next($request);
        }
        return redirect()->route('admin_show_login');
    }
}

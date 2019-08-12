<?php

namespace App\Http\Middleware;

use Closure;
use App\vestidosUserWishlists as Wishlists;
use Session;
use Auth;

class checkUserWishlistAccess
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
        $user_id =Auth::guard("vestidosUsers")->user()->getId();
        $wisthlist =Wishlists::find($request->wishlist_id);
        if($wisthlist->user_id !== $user_id){
            return redirect()->back();
        }
        return $next($request);
    }
}

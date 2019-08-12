<?php

namespace App\Http\Middleware;

use Closure;
use App\vestidosUserAddresses as Addresses;
use Session;
use Auth;

class checkUserAddressAccess
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
        $address =Addresses::find($request->address_id);
        if($address->user_id !== $user_id){
            return redirect()->back();
        }
        return $next($request);
    }
}

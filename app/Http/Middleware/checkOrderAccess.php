<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Auth;
use App\vestidosOrders as Orders;

class checkOrderAccess
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
        $order =Orders::find($request->order_id);
        if($order->user_id !== $user_id){
            return redirect()->back();
        }
        return $next($request);
    }
}

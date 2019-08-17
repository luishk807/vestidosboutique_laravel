<?php

namespace App\Http\Middleware;

use Closure;

use App\vestidosMainConfigs as MainConfig;
use Session;
use Auth;

class checkShippingAllowed
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
        $cart = $request->session()->get('cart_session');
        $config = MainConfig::first();
        if(!$config->allow_shipping){
            return redirect()->route("checkout_show_billing");
        }
        return $next($request);
    }
}

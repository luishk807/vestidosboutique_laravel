<?php

namespace App\Http\Middleware;

use Closure;
use App\vestidosMainConfigs as MainConfig;
use Session;
use Auth;

class checkShippingMissing
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
        $config = MainConfig::first();
        $cart = $request->session()->get('cart_session');
        if($config->allow_shipping && !isset($cart["shipping_method"])){
            return redirect()->route("checkout_show_shipping")->withErrors([
                'required' => __('general.page_header.provide_shipping')
            ]);
        }
        return $next($request);
    }
}

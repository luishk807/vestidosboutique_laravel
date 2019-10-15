<?php

namespace App\Http\Middleware;

use Closure;
use App\vestidosMainConfigs as MainConfig;
class checkAdminOrderBillingShipping
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
        $main_config = MainConfig::first();
        if(!$main_config->allow_shipping && !$main_config->allow_billing){
            return redirect()->route("admin_new_order_products");
        }
        return $next($request);
    }
}

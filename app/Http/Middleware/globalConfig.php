<?php

namespace App\Http\Middleware;

use Closure;

class globalConfig
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
        $data=[
            "support_email"=>"info@vestidosboutique.com",
            "support_phone"=>"+507 203-5848",
            "sales_email"=>"pedidos@vestidosboutique.com",
            "url"=>"www.vestidosboutique.com"
        ];
        $request->merge(array("configData" => $data));
        
        view()->share('configData',$data);
        
        return $next($request);
    }
}

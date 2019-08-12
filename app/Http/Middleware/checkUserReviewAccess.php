<?php

namespace App\Http\Middleware;

use Closure;
use App\vestidosProductRates as Rates;
use Session;
use Auth;

class checkUserReviewAccess
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
        $review =Rates::find($request->review_id);
        if($review->user_id !== $user_id){
            return redirect()->back();
        }
        return $next($request);
    }
}

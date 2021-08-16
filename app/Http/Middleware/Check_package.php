<?php

namespace App\Http\Middleware;

use Closure;

class Check_package
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

        if(auth()->user()->parent_id == null) {
            $expiry_date = auth()->user()->expiry_date;
            $expiry_package = auth()->user()->expiry_package;
            $package_name = auth()->user()->Package->name;
        }else {
            $parent_user = \App\User::where('id', auth()->user()->parent_id)->first();
            $expiry_date = $parent_user->expiry_date;
            $expiry_package = $parent_user->expiry_package;
            $package_name = $parent_user->Package->name;
        }

        if($expiry_package == 'y'){
            return back();
        }else{
            return $next($request);
        }
    }
}

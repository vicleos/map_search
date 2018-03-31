<?php

namespace App\Http\Middleware;

use Closure;

class CheckSubDomain
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
    public function handle($request, Closure $next)
    {
    	// 城市目录发生变化时
    	$isUpdateCity = isset($_COOKIE['city_dir']) && $request->__get('city_dir') != $_COOKIE['city_dir'];
    	// 不存在城市 cookie 时
    	$isCreateCity = !isset($_COOKIE['city_dir']);
    	if($isUpdateCity || $isCreateCity){
			setcookie('city_dir', $request->__get('city_dir'));
		}
        return $next($request);
    }
}

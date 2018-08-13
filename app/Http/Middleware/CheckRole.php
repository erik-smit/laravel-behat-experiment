<?php namespace App\Http\Middleware;

// First copy this file into your middleware directoy

use Closure;

class CheckRole{

    /**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next, $role)
	{
		list($method, $role) = explode(":", "$role:");

		if($role && (!$request->isMethod($method) || $request->user()->hasRole($role)) ||
			$request->user()->hasRole($method)) {
			return $next($request);
		}
        
		return response([
			'error' => [
				'code' => 'INSUFFICIENT_ROLE',
				'description' => 'You are not authorized to access this resource.'
			]
		], 401);
    }
}
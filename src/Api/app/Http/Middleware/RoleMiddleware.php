<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
	public function handle(Request $request, Closure $next, ...$roles)
	{
		if ($request->user() && in_array($request->user()->role, $roles)) {
			return $next($request);
		}

		abort(403, 'Unauthorized');
	}
}

<?php

namespace App\Modules\AccountSystem\middleware;

use App\Modules\AccountSystem\Clients\Contracts\AccountSystemClientInterface;
use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function __construct(
        private AccountSystemClientInterface $userLoginClient
    ){
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $results = $this->userLoginClient->getUserByIdAndToken(session()->get('user_id'), session()->get('api_token'));
        if($results['role'] === 'Admin'){
            return $next($request);
        }
        return Response(json_encode('Unauthorized'), 401);
    }
}

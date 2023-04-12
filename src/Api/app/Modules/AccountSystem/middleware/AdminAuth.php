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
        if(!session()->get('role')){
            return Response(json_encode('Incorrect role', 500));
        }
        $results = $this->userLoginClient->getRole(session()->get('role'), session()->get('api_token'));
        if(!$results['role'] == 'admin'){
            return Response(json_encode('Unauthorized'), 401);
        }
        return $next($request);
    }
}

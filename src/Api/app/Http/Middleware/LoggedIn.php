<?php

namespace App\Http\Middleware;

use App\Modules\AccountSystem\Clients\Contracts\AccountSystemClientInterface;
use Closure;
use Illuminate\Http\Request;

class LoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function __construct(
        private AccountSystemClientInterface $userLoginClient
    ){
    }

    public function handle(Request $request, Closure $next)
    {
//        if($request['id'] && $request['api_token']){
//            if($this->userLoginClient->getUserByApiToken($request['id'], $request['api_token'])){
//                return $next($request);
//            }
//        }
        return $next($request);
//        return response('Unauthorized.', 401);
    }
}

<?php

namespace App\Modules\AccountSystem\middleware;

use Closure;
use Illuminate\Http\Request;
use App\Modules\AccountSystem\Clients\Contracts\AccountSystemClientInterface;
use GuzzleHttp\Psr7\Response;

class UserAuth
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
        $results = $this->userLoginClient->getUserByIdAndToken($request['id'], $request->bearerToken());
        if($results->isempty()){
            return Response(json_encode('Unauthorized'), 401);
        }
        return $next($request);
    }
}

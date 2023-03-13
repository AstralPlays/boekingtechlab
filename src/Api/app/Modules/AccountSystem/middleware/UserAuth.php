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
        if(!$request['user_id'] or !$request->bearerToken()){
            return Response(json_encode('Missing a parameter'), 400);
        }
        $results = $this->userLoginClient->getUserByIdAndToken($request['user_id'], $request->bearerToken());
        if(!$results){
            return Response(
                [
                    'auth' => 'Unauthorized',
                    'role' => 'null'
                ], 401);
        }
        return $next($request);
    }
}

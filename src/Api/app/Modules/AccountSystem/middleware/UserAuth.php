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
        if(!session()->get('user_id') or !session()->get('api_token')){
            return Response(json_encode('Missing Login Token.', 500));
        }

        $results = $this->userLoginClient->getUserByIdAndToken(session()->get('user_id'), session()->get('api_token'));
        if(!$results){
            return Response(json_encode('Unauthorized'), 401);
        }
        return $next($request);
    }
}

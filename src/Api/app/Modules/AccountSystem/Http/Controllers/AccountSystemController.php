<?php

namespace App\Modules\AccountSystem\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\AccountSystem\Clients\Contracts\AccountSystemClientInterface;
use App\Modules\AccountSystem\Requests\StoreLoginRequest;
use App\Modules\AccountSystem\Requests\StoreRegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use \Illuminate\Database\Eloquent\Collection;

class AccountSystemController extends Controller
{
    public function __construct(
        private AccountSystemClientInterface $userLoginClient
    ){
    }

    public function index(): Collection
    {
        return $this->userLoginClient->all();
    }

    public function register(StoreRegisterRequest $request): array
    {
        $uuid = Str::uuid()->toString();
        $account = $this->userLoginClient->create(
            [
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'api_token' => $uuid
            ]);
        return [
            'id' => $account['id'],
            'api_token' => $uuid
        ];
    }

    public function login(StoreLoginRequest $request): array|bool
    {
        if($user = $this->userLoginClient->getUser($request['email'], $request['password'])){
            return [
                'id' => $user['id'],
                'api_token' => $user['api_token']
            ];
        }
        return false;
    }

}
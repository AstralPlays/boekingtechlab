<?php

namespace App\Modules\AccountSystem\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\AccountSystem\Clients\Contracts\AccountSystemClientInterface;
use App\Modules\AccountSystem\Requests\StoreRegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AccountSystemController extends Controller
{
    public function __construct(
        private AccountSystemClientInterface $userLoginClient
    ){
    }

    public function index()
    {
        return $this->userLoginClient->all();
    }

    public function register(StoreRegisterRequest $request)
    {
        $uuid = Str::uuid()->toString();
        $account = $this->userLoginClient->create(
            [
                'email' => $request['email'],
                'password' => Hash::make($request),
                'api_token' => $uuid
            ]);
        return [
            'id' => $account['id'],
            'api_token' => $uuid
        ];
    }

}

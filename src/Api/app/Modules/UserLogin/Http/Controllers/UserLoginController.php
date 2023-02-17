<?php

namespace App\Modules\UserLogin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\UserLogin\Clients\Contracts\UserLoginClientInterface;
use http\Client\Request;
use Illuminate\Http\Response;

class UserLoginController extends Controller
{
    public function __construct(
        private UserLoginClientInterface $userLoginClient
    ){
    }

    public function index()
    {
        return $this->userLoginClient->all();
    }

}

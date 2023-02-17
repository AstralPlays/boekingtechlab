<?php

namespace App\Modules\UserLogin;

use App\Modules\UserLogin\Clients\Contracts\UserLoginClientInterface;
use App\Modules\UserLogin\Clients\UserLoginClient;
use Illuminate\Support\ServiceProvider;

class UserLoginServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(UserLoginClientInterface::class, UserLoginClient::class);
    }

    public function boot()
    {

    }
}

<?php

namespace App\Modules\AccountSystem;

use App\Modules\AccountSystem\Clients\Contracts\AccountSystemClientInterface;
use App\Modules\AccountSystem\Clients\AccountSystemClient;
use Illuminate\Support\ServiceProvider;

class AccountSystemServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(AccountSystemClientInterface::class, AccountSystemClient::class);
    }

    public function boot()
    {

    }
}

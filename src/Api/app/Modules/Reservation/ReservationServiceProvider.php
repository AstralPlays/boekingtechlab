<?php

namespace App\Modules\Reservation;

use App\Modules\Reservation\Clients\Contracts\ReservationClientInterface;
use App\Modules\Reservation\Clients\ReservationClient;
use Illuminate\Support\ServiceProvider;

class ReservationServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(ReservationClientInterface::class, ReservationClient::class);
    }

    public function boot()
    {

    }
}

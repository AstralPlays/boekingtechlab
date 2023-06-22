<?php

namespace App\Modules\Room;

use App\Modules\Room\Clients\Contracts\RoomClientInterface;
use App\Modules\Room\Clients\RoomClient;
use Illuminate\Support\ServiceProvider;

class RoomServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind(RoomClientInterface::class, RoomClient::class);
	}

	public function boot()
	{
		
	}
}

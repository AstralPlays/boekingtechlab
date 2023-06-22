<?php

namespace App\Modules\Material;

use App\Modules\Material\Clients\Contracts\MaterialClientInterface;
use App\Modules\Material\Clients\MaterialClient;
use Illuminate\Support\ServiceProvider;

class MaterialServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind(MaterialClientInterface::class, MaterialClient::class);
	}

	public function boot()
	{
		
	}
}

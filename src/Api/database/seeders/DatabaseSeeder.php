<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Reservation;
use App\Models\material;
use App\Models\room;
use App\Models\reservationMaterial;
use App\Models\reservationRoom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		// admin user
		User::create([
			'name' => 'Admin User',
			'email' => 'admin@example.com',
			'password' => Hash::make('password'),
			'phone_number' => '0612345678',
			'role' => 'Admin',
			'api_token' => Str::uuid()->toString(),
		]);
		// normal user
		User::create([
			'name' => 'Normal User',
			'email' => 'normal@example.com',
			'password' => Hash::make('password'),
			'phone_number' => '0612345678',
			'role' => 'User',
			'api_token' => Str::uuid()->toString(),
		]);
		room::create([
			'name' => 'Test Room',
		]);
		material::create([
			'name' => 'Test Material',
			'ammount' => '1',
			'rooms_id' => '1',
		]);
		Reservation::create([
			'user_id' => '1',
			'start_time' => '2021-05-18 13:35:03',
			'end_time' => '2021-05-18 13:35:03',
			'date' => '2023-05-25',
		]);
		reservationRoom::create([
			'reservation_id' => '1',
			'room_id' => '1',
		]);
		reservationMaterial::create([
			'reservation_id' => '1',
			'material_id' => '1',
		]);
	}
}

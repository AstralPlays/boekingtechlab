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
			'api_token' => 'e8059899-b3a0-4136-8598-546d2fb0d620',
		]);
		// normal user
		User::create([
			'name' => 'Normal User',
			'email' => 'normal@example.com',
			'password' => Hash::make('password'),
			'phone_number' => '0612345678',
			'role' => 'User',
			'api_token' => 'a03f480e-d486-4793-b558-58a2fc41b2aa',
		]);
		room::create([
			'name' => 'Test Room 1',
			'image' => 'logo.png',
		]);
		room::create([
			'name' => 'Test Room 2',
			'image' => 'logo.png',
		]);
		room::create([
			'name' => 'Test Room 3',
			'image' => 'logo.png',
		]);
		room::create([
			'name' => 'Test Room 4',
			'image' => 'logo.png',
		]);
		room::create([
			'name' => 'Test Room 5',
			'image' => 'logo.png',
		]);
		room::create([
			'name' => 'Test Room 6',
			'image' => 'logo.png',
		]);
		room::create([
			'name' => 'Test Room 7',
			'image' => 'logo.png',
		]);
		room::create([
			'name' => 'Test Room 8',
			'image' => 'logo.png',
		]);
		material::create([
			'name' => 'Test Material 1',
			'quantity' => '3',
			'image' => 'logo.png',
			'rooms_id' => '1',
		]);
		material::create([
			'name' => 'Test Material 2',
			'quantity' => '3',
			'image' => 'logo.png',
			'rooms_id' => '1',
		]);
		material::create([
			'name' => 'Test Material 3',
			'quantity' => '3',
			'image' => 'logo.png',
			'rooms_id' => '1',
		]);
		material::create([
			'name' => 'Test Material 4',
			'quantity' => '3',
			'image' => 'logo.png',
			'rooms_id' => '1',
		]);
		material::create([
			'name' => 'Test Material 5',
			'quantity' => '3',
			'image' => 'logo.png',
			'rooms_id' => '1',
		]);
		material::create([
			'name' => 'Test Material 6',
			'quantity' => '3',
			'image' => 'logo.png',
			'rooms_id' => '1',
		]);
		material::create([
			'name' => 'Test Material 7',
			'quantity' => '3',
			'image' => 'logo.png',
			'rooms_id' => '1',
		]);
		material::create([
			'name' => 'Test Material 8',
			'quantity' => '10',
			'image' => 'logo.png',
			'rooms_id' => '2',
		]);
		Reservation::create([
			'user_id' => '1',
			'start_time' => '10:00:00',
			'end_time' => '13:00:00',
			'date' => '2023-05-30',
		]);
		reservationRoom::create([
			'reservation_id' => '1',
			'room_id' => '1',
		]);
		reservationRoom::create([
			'reservation_id' => '1',
			'room_id' => '2',
		]);
		reservationMaterial::create([
			'reservation_id' => '1',
			'material_id' => '1',
			'quantity' => '3',
		]);
		reservationMaterial::create([
			'reservation_id' => '1',
			'material_id' => '2',
			'quantity' => '5',
		]);
	}
}

<?php

namespace App\Modules\Reservation\Clients;

use App\Models\Reservation;
use App\Modules\Reservation\Clients\Contracts\ReservationClientInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class ReservationClient implements ReservationClientInterface
{
	function all(): Collection
	{
		return Reservation::all();
	}

	function get(string $search, string $variable): Collection
	{
		return Reservation::where($search, $variable)->get();
	}

	function getByDate(string $date, int $rooms_id): Collection
	{
		return Reservation::where(
			[
				'date' => $date,
				'rooms_id' => $rooms_id
			]
		)->get();
	}

	function getByDateAdmin(string $date): Collection
	{
		return Reservation::with(
			[
				'user' => function ($query) {
					$query->select('id', 'name', 'email', 'phone_number');
				},
				'rooms' => function ($query) {
					$query->select('name');
				},
				'materials' => function ($query) {
					$query->select('name');
				}

			]
		)
			->select('id', 'user_id', 'start_time', 'end_time', 'verified')
			->where('date', $date)
			->get();
	}

	function create(array $variable): Reservation
	{
		return Reservation::create($variable);
	}

	function delete(string $search, string $variable): Reservation
	{
		return Reservation::where($search, $variable)->delete();
	}
}

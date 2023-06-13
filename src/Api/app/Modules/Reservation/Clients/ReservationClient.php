<?php

namespace App\Modules\Reservation\Clients;

use App\Models\material;
use App\Models\Reservation;
use App\Models\room;
use App\Modules\Reservation\Clients\Contracts\ReservationClientInterface;
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

	function getByDate(string $date, array $rooms): Collection
	{
		return Reservation::with('rooms')
			->has('rooms')
			->whereHas('rooms', function ($query) use ($rooms) {
				$query->whereIn('rooms.id', $rooms);
			})
			->where('date', $date)
			->get();
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
					$query->select('name', 'reservation_material.quantity');
				}

			]
		)
			->select('id', 'user_id', 'start_time', 'end_time', 'state')
			->where('date', $date)
			->get();
	}

	function getRooms(): Collection
	{
		return room::select('id', 'name', 'image')->get();
	}

	function getMaterials(): Collection
	{
		return material::select('id', 'name', 'quantity', 'image', 'rooms_id')->get();
	}

	function getReservedMaterials(string $date): Collection
	{
		return Reservation::with([
			'materials' => function ($query) {
				$query->select('reservation_material.id', 'reservation_material.quantity');
			}
		])
			->has('materials')
			->select('id', 'start_time', 'end_time')
			->where('date', '=', $date)
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

	function changeState(int $id, string $state): int
	{
		return Reservation::where('id', $id)->update(['state' => $state]);
	}

	function getUserReservations(): Collection
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
					$query->select('name', 'reservation_material.quantity');
				}

			]
		)
			->select('id', 'user_id', 'start_time', 'end_time', 'state', 'date')
			->where('user_id', session()->get('user_id'))
			->get();
	}

	function removeUserReservation(int $id): int
	{
		return Reservation::where('user_id', session()->get('user_id'))
			->where('id', $id)
			->delete();
	}
}

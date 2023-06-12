<?php

namespace App\Modules\Reservation\Clients\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Reservation;

interface ReservationClientInterface
{
	function all(): Collection;

	function get(string $search, string $variable): Collection;

	function create(array $variable): Reservation;

	function changeState(int $id, string $state): int;

	function getByDate(string $date, array $rooms): Collection;

	function getByDateAdmin(string $date): Collection;

	function getRooms(): Collection;

	function getMaterials(): Collection;

	function getReservedMaterials(string $date): Collection;

	function delete(string $search, string $variable): Reservation;
}

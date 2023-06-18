<?php

namespace App\Modules\Reservation\Clients\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Models\reservation;

interface ReservationClientInterface
{
	function all(): Collection;

	function get(string $search, string $variable): Collection;

	function create(array $variable): reservation;

	function changeState(int $id, string $state): int;

	function getByDate(string $date, array $rooms): Collection;

	function getByDateAdmin(string $date): Collection;

	function getRooms(): Collection;

	function getMaterials(): Collection;

	function getReservedMaterials(string $date): Collection;

	function getUserNextReservation(): reservation|null;

	function getAdminNextReservation(): reservation|null;

	function getTotalReservationsToday(): int;

	function getUserReservations(): Collection;

	function removeUserReservation(int $id): int;

	function delete(string $search, string $variable): reservation;
}

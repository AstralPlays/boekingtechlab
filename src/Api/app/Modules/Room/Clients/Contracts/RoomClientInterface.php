<?php

namespace App\Modules\Room\Clients\Contracts;

use App\Models\room;
use Illuminate\Database\Eloquent\Collection;

interface RoomClientInterface
{
	function all(): Collection;

	function get(string $search, string $variable): Collection;

	function getRooms(): Collection;

	function addRoom(array $room): room;

	function removeRoom(int $id): int;
}

<?php

namespace App\Modules\Room\Clients;

use App\Models\room;
use App\Modules\Room\Clients\Contracts\RoomClientInterface;
use Illuminate\Database\Eloquent\Collection;

class RoomClient implements RoomClientInterface
{
	function all(): Collection
	{
		return room::all();
	}

	function get(string $search, string $variable): Collection
	{
		return room::where($search, $variable)->get();
	}

	public function getRooms(): Collection
	{
		return room::select('id', 'name', 'image')->get();
	}

	public function addRoom(array $room): room
	{
		return room::create($room);
	}

	public function removeRoom(int $id): int
	{
		$room = room::find($id);
		if ($room) {
			return $room->delete();
		}
		return 0;
	}
}

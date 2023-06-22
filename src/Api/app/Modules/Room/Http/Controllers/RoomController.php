<?php

namespace App\Modules\Room\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Room\Clients\Contracts\RoomClientInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RoomController extends Controller
{
	public function __construct(
		private RoomClientInterface $RoomClient
	) {
	}

	public function index()
	{
		return $this->RoomClient->all();
	}

	public function getRooms(): array
	{
		$rooms = $this->RoomClient->getRooms();
		$list = [];
		foreach ($rooms as $room) {
			$list[] = [
				'id' => $room->id,
				'name' => $room->name,
				'image' => $room->image,
			];
		}
		return $list;
	}

	public function addRoom(Request $request)
	{
		try {
			$validator = Validator::make($request->all(), [
				'roomName' => 'required|string',
				'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			])->validate();
		} catch (ValidationException $exception) {
			return Response(json_encode(['error' => $exception->errors()]), 415);
		}

		$roomName = $request['roomName'];
		$imageName = time() . '.' . request()->image->getClientOriginalExtension();
		request()->image->move(public_path('images/rooms'), $imageName);

		$room = [
			'name' => $roomName,
			'image' => $imageName
		];

		if ($this->RoomClient->addRoom($room)) {
			return Response(json_encode(['success' => $room]), 200);
		}

		return Response(json_encode('error'), 400);
	}

	public function removeRoom(Request $request)
	{
		$id = $request['id'];
		if ($this->RoomClient->removeRoom($id)) {
			return Response(json_encode('success'), 200);
		}
		return Response(json_encode('Room Not Found'), 404);
	}
}

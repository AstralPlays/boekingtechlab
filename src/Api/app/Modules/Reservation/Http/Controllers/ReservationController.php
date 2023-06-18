<?php

namespace App\Modules\Reservation\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\reservation;
use App\Modules\Reservation\Clients\Contracts\ReservationClientInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ReservationController extends Controller
{
	public function __construct(
		private ReservationClientInterface $reservationClient
	) {
	}

	public function index()
	{
		return $this->reservationClient->all();
	}

	public function create(Request $request)
	{
		/* Check if user is not logged in */
		if (!session()->has('user_id')) return Response(json_encode('Unauthorized'), 401);
		/* check if a date is selected */
		if (!filled($request['date'])) return Response(json_encode('No date selected'), 400);
		/* check if a room is selected */
		if (!filled($request['rooms'])) return Response(json_encode('No room selected'), 400);
		/* check if a start time is selected */
		if (!filled($request['start_time'])) return Response(json_encode('No start time selected'), 400);
		/* check if a end time is selected */
		if (!filled($request['end_time'])) return Response(json_encode('No end time selected'), 400);

		/* validation rules */
		$validator = Validator::make($request->all(), [
			'name' => 'string|nullable',
			'email' => 'email|nullable',
			'start_time' => 'required',
			'end_time' => 'required',
			'date' => 'required',
			'rooms' => 'array',
			'rooms.*' => 'numeric',
			'materials' => 'array|nullable',
			'materials.*.material_id' => 'required|integer',
			'materials.*.quantity' => 'required|integer',
		]);
		/* validate the values */
		try {
			$validator->validate();
		} catch (ValidationException $exception) {
			return Response(json_encode(['error' => $exception->errors()]), 400);
		}

		/* Convert JS Time to a Carbon Object. */
		$start_time = Carbon::parse($request['start_time']);
		$end_time = Carbon::parse($request['end_time']);
		$date = Carbon::parse($request['date']);

		/* Check if the start time is the same as the end time */
		if ($start_time->eq($end_time)) return Response(json_encode('The start time can\'t be the same as the end time'), 409);
		/* Check if the start time is later than the end time */
		if ($start_time->gt($end_time)) return Response(json_encode('The start time can\'t be later than the end time'), 409);
		/* Check if the start time is earlier than the opening time */
		if (($request['start_time'] < '09:00:00')) return Response(json_encode('The start time can\'t be earlier than the opening time'), 422);
		/* Check if the end time is later than the closing time */
		if (($request['end_time'] > '17:00:00')) return Response(json_encode('The End time can\'t be later than the closing time'), 422);
		/* Check if the date is earlier than the day after tomorrow */
		if ($date->isBefore(Carbon::tomorrow()->addDay(1))) return Response(json_encode('The date should be at least after 2 days from the current day'), 422);
		if (!str_contains($request['start_time'], ':00') and !str_contains($request['start_time'], ':15') and !str_contains($request['start_time'], ':30') and !str_contains($request['start_time'], ':45')) return Response(json_encode('Invalid Time Format'), 412);
		if (!str_contains($request['end_time'], ':00') and !str_contains($request['end_time'], ':15') and !str_contains($request['end_time'], ':30') and !str_contains($request['end_time'], ':45')) return Response(json_encode('Invalid Time Format'), 412);

		$reservations = $this->reservationClient->getByDate($date->format('Y-m-d'), $request['rooms']);

		foreach ($reservations as $reservering) {
			if (Carbon::parse($reservering['start_time'])->isBetween($start_time, $end_time) or Carbon::parse($reservering['end_time'])->isBetween($start_time, $end_time)) {
				if ($start_time->eq($reservering['end_time']) or $end_time->eq($reservering['start_time'])) {
					continue;
				}
				return Response(json_encode('Cannot Place reservation'), 409);
			}
		}

		$reservationData = [
			'user_id' => session()->get('user_id'),
			'name' => $request['name'],
			'email' => $request['email'],
			'start_time' => $start_time,
			'end_time' => $end_time,
			'date' => $date
		];

		$reservation = $this->reservationClient->create($reservationData);

		$reservation->rooms()->attach($request['rooms']);

		if (filled($request['materials'])) {
			$reservation->materials()->attach($request['materials']);
		}

		$reservation->save();

		return Response(json_encode('success'), 200);
	}

	public function changeState(Request $request)
	{
		$id = $request['id'];
		$state = $request['state'];

		if ($this->reservationClient->changeState($id, $state)) {
			return Response(json_encode('success'), 200);
		}
		return Response(json_encode('failed'), 400);
	}

	public function getByDate(Request $request)
	{
		if (!filled($request['date'])) return Response(json_encode('Invalid Argument | 007.4'), 412);
		if (!filled($request['rooms'])) return Response(json_encode('Invalid Argument | 007.5'), 412);

		$dateFormatted = Carbon::parse($request['date']);

		if ($dateFormatted->isBefore(Carbon::tomorrow()->addDay(1))) {
			return [
				[
					'start_time' => '09:00',
					'end_time' => '17:00'
				]
			];
		}
		$Reservations = $this->reservationClient->getByDate($dateFormatted->format('Y-m-d'), $request['rooms']);
		$list = [];
		return $Reservations;
		foreach ($Reservations as $reservation) {
			$list[] = [
				'start_time' => $reservation['start_time'],
				'end_time' =>  $reservation['end_time']
			];
		}
		return $list;
	}

	public function getByDateAdmin(Request $request): array
	{
		$dateFormatted = Carbon::parse($request['date']);
		$Reservations = $this->reservationClient->getByDateAdmin($dateFormatted->format('Y-m-d'));
		$list = [];
		foreach ($Reservations as $reservation) {
			$list[] = [
				'id' => $reservation['id'],
				'rooms' => $reservation['rooms'],
				'materials' => $reservation['materials'],
				'start_time' => $reservation['start_time'],
				'end_time' =>  $reservation['end_time'],
				'state' =>  $reservation['state'],
				'user_name' =>  $reservation['user']['name'],
				'user_email' =>  $reservation['user']['email'],
				'user_phone_number' =>  $reservation['user']['phone_number'],
			];
		}
		return $list;
	}

	public function getRooms(): array
	{
		$rooms = $this->reservationClient->getRooms();
		$list = [];
		foreach ($rooms as $room) {
			$list[] = [
				'id' => $room['id'],
				'name' => $room['name'],
				'image' => $room['image'],
			];
		}
		return $list;
	}

	public function getMaterials(): array
	{
		$mats = $this->reservationClient->getMaterials();
		$list = [];
		foreach ($mats as $mat) {
			$list[] = [
				'id' => $mat['id'],
				'name' => $mat['name'],
				'quantity' => $mat['quantity'],
				'image' => $mat['image'],
				'rooms_id' => $mat['rooms_id'],
			];
		}
		return $list;
	}

	public function getReservedMaterials(Request $request): array
	{
		$start_time = Carbon::parse($request['start_time']);
		$end_time = Carbon::parse($request['end_time']);
		$date = Carbon::parse($request['date']);

		$reservedMats = $this->reservationClient->getReservedMaterials($date->format('Y-m-d'));
		$mats = $this->getMaterials();
		$tmpList = [];
		foreach ($reservedMats as $reservedMat) {
			if ($start_time->isBetween(Carbon::parse($reservedMat['start_time']), Carbon::parse($reservedMat['end_time'])) or $end_time->isBetween(Carbon::parse($reservedMat['start_time']), Carbon::parse($reservedMat['end_time']))) {
				if (!($start_time->eq($reservedMat['end_time']) or $end_time->eq($reservedMat['start_time']))) {
					foreach ($reservedMat['materials'] as $materials) {
						$tmpList[] = [
							'id' => $materials['material_id'],
							'quantity' => $materials['quantity'],
						];
					}
				}
			}
		}

		$list = [];
		foreach ($mats as $item) {
			$id = $item['id'];
			$quantity1 = $item['quantity'];

			// Find the corresponding item in array 2
			$item2 = collect($tmpList)->firstWhere('id', $id);

			if ($item2) {
				$quantity2 = $item2['quantity'];
				$item['quantity'] = max(0, $quantity1 - $quantity2); // Subtract the quantities
			}

			$list[] = $item;
		}

		return $list;
	}

	public function getUserNextReservation(): reservation|array
	{
		$reservation = $this->reservationClient->getUserNextReservation();
		$list = [];
		if ($reservation != null) {
			$list[] = $reservation;
		}
		return $list;
	}

	public function getAdminNextReservation(): reservation|array
	{
		$reservation = $this->reservationClient->getAdminNextReservation();
		$list = [];
		if ($reservation != null) {
			$list[] = $reservation;
		}
		return $list;
	}

	public function getTotalReservationsToday(): int
	{
		return $this->reservationClient->getTotalReservationsToday();
	}

	public function getUserReservations(): array
	{
		$Reservations = $this->reservationClient->getUserReservations();
		$list = [];
		foreach ($Reservations as $reservation) {
			$list[] = [
				'id' => $reservation['id'],
				'user_name' =>  $reservation['user']['name'],
				'user_email' =>  $reservation['user']['email'],
				'user_phone_number' =>  $reservation['user']['phone_number'],
				'date' =>  $reservation['date'],
				'start_time' => $reservation['start_time'],
				'end_time' =>  $reservation['end_time'],
				'materials' => $reservation['materials'],
				'rooms' => $reservation['rooms'],
				'state' =>  $reservation['state'],
			];
		}
		return $list;
	}

	public function removeUserReservation(Request $request)
	{
		$id = $request['id'];
		if ($this->reservationClient->removeUserReservation($id)) {
			return Response(json_encode('success'), 200);
		}
		return Response(json_encode('failed'), 400);
	}
}

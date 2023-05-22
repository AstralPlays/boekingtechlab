<?php

namespace App\Modules\Reservation\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Reservation\Clients\Contracts\ReservationClientInterface;
use app\Modules\Reservation\Requests\StoreCreateReservationRequest;
use App\View\Components\reservation;
use Illuminate\Http\Request;
use Illuminate\Http\Response as Response;
use Carbon\Carbon;

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
		$start_time = Carbon::parse($request['start_time']);
		$end_time = Carbon::parse($request['end_time']);

		if ($start_time->eq($end_time)) return Response(json_encode('Invalid Argument | 007.1'), 412);

		/* Convert JS Time to a Carbon Object. */
		$date = Carbon::parse($request['date']);

		/* Check if time is not before opening time or later then closing time */
		if (($request['start_time'] < '09:00:00') or ($request['end_time'] > '17:00:00')) return Response(json_encode('Invalid Argument | 007.2'), 412);
		if ($date->isBefore(Carbon::tomorrow()->addDay(1))) return Response(json_encode('Invalid Argument | 007.3'), 412);
		if (!str_contains($request['start_time'], ':00') and !str_contains($request['start_time'], ':15') and !str_contains($request['start_time'], ':30') and !str_contains($request['start_time'], ':45')) return Response(json_encode('Invalid Time Format'), 412);
		if (!str_contains($request['end_time'], ':00') and !str_contains($request['end_time'], ':15') and !str_contains($request['end_time'], ':30') and !str_contains($request['end_time'], ':45')) return Response(json_encode('Invalid Time Format'), 412);

		$alloftoday = $this->reservationClient->getByDate($date->format('Y-m-d'), $request['rooms_id']);

		foreach ($alloftoday as $reservering) {
			if (Carbon::parse($reservering['start_time'])->isBetween($start_time, $end_time) or Carbon::parse($reservering['end_time'])->isBetween($start_time, $end_time)) {
				if ($start_time->eq($reservering['end_time']) or $end_time->eq($reservering['start_time'])) {
					continue;
				}
				return Response(json_encode('Cannot Place Appointment | 1'), 400);
			}
		}

		$reservationData = [
			'user_id' => session()->get('user_id'),
			'date' => $date,
			'start_time' => $start_time,
			'end_time' => $end_time,
		];

		$materials = $request['materials'] ?? [];
		$rooms = $request['rooms'] ?? [];

		$reservation = $this->reservationClient->create($reservationData);

		if (!empty($materials)) {
			$reservation->materials()->attach($materials);
		}

		if (!empty($rooms)) {
			$reservation->rooms()->attach($rooms);
		}

		return Response(json_encode('success'), 200);
	}

	public function getByDate(Request $request): array
	{
		$dateFormatted = Carbon::parse($request['date']);
		if ($dateFormatted->isBefore(Carbon::tomorrow()->addDay(1))) {
			return [
				[
					'start_time' => '09:00',
					'end_time' => '17:00'
				]
			];
		}
		$Reservations = $this->reservationClient->getByDate($dateFormatted->format('Y-m-d'), $request['rooms_id']);
		$list = [];
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
				// $reservation,
				'id' => $reservation['id'],
				'rooms' => $reservation['rooms'],
				'materials' => $reservation['materials'],
				'start_time' => $reservation['start_time'],
				'end_time' =>  $reservation['end_time'],
				'verified' =>  $reservation['verified'],
				'user_name' =>  $reservation['user']['name'],
				'user_email' =>  $reservation['user']['email'],
				'user_phone_number' =>  $reservation['user']['phone_number'],
			];
		}
		return $list;
	}
}

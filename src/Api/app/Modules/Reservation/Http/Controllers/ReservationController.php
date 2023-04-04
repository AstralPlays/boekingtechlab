<?php

namespace App\Modules\Reservation\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Reservation\Clients\Contracts\ReservationClientInterface;
use app\Modules\Reservation\Requests\StoreCreateReservationRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response as Response;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function __construct(
        private ReservationClientInterface $reservationClient
    ){
    }

    public function index()
    {
        return $this->reservationClient->all();
    }

    public function create(Request $request)
    {

        $start_time = Carbon::parse($request['start_time']);
        $end_time = Carbon::parse($request['end_time']);

        /* Convert JS Time to a Carbon Object. */
        $date = Carbon::parse($request['date']);
        /* Check if time is not before opening time or later then closing time */
        if(($request['start_time'] < '09:00') or ($request['end_time'] > '17:00'))
        {
            return Response(json_encode('Invalid Argument | 007.1'), 412);
        }
        if($date->isPast(Carbon::tomorrow()))
        {
            return Response(json_encode('Invalid Argument | 007.2'), 412);
        }

        if(!str_contains($request['start_time'], ':00') and !str_contains($request['start_time'], ':15') and !str_contains($request['start_time'], ':30') and !str_contains($request['start_time'], ':45')){
            return Response(json_encode('Invalid Time Format'), 412);
        }

        if(!str_contains($request['end_time'], ':00') and !str_contains($request['end_time'], ':15') and !str_contains($request['end_time'], ':30') and !str_contains($request['end_time'], ':45')){
            return Response(json_encode('Invalid Time Format'), 412);
        }

        $alloftoday = $this->reservationClient->getByDate($date->format('Y-m-d'));

        foreach($alloftoday as $reservering)
        {
            if(Carbon::parse($request['start_time']) == Carbon::parse($reservering['end_time']))
            {
                continue;
            }
            if(Carbon::parse($request['end_time']) == Carbon::parse($reservering['start_time']))
            {
                continue;
            }
            if(Carbon::parse($request['start_time'])->isBetween(Carbon::parse($reservering['start_time']),Carbon::parse($reservering['end_time'])))
            {
                return Response(json_encode('Cannot Place Appointment'), 400);
            }

            if(Carbon::parse($request['end_time'])->isBetween(Carbon::parse($reservering['start_time']),Carbon::parse($reservering['end_time'])))
            {
                return Response(json_encode('Cannot Place Appointment'), 400);
            }
        }

        if(!$request['materials']){
             return $this->reservationClient->create(
                [
                    'userID' => session()->get('user_id'),
                    'date' => $date,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'materials' => json_encode($request['materials'])
                ]);
        }
        return $this->reservationClient->create(
            [
                'userID' => session()->get('user_id'),
                'date' => $date,
                'start_time' => $start_time,
                'end_time' => $end_time,
            ]);
    }

    public function getByDate(Request $request): array
    {
        $dateFormatted = Carbon::parse($request['date']);
        $Reservations = $this->reservationClient->getByDate($dateFormatted->format('Y-m-d'));
        $list = [];
        foreach($Reservations as $key => $reservation){
            $list[] = [
                'start_time' => $reservation['start_time'],
                'end_time' =>  $reservation['end_time']
            ];
        }
        return $list;
    }
}

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
        $date = Carbon::parse(date_create_from_format('D M d', $request['date']));
        /* Check if time is not before opening time or later then closing time */
        if(($request['start_time'] < '09:00') or ($request['end_time'] > '17:00'))
        {
            return Response(json_encode('Invalid Argument'), 412);
        }
        if(Carbon::tomorrow()->isBefore(Carbon::parse($date)))
        {
            return Response(json_encode('Invalid Argument'), 412);
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
                    'userID' => $request['user_id'],
                    'date' => $date,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'materials' => json_encode($request['materials'])
                ]);
        }
        return $this->reservationClient->create(
            [
                'userID' => $request['user_id'],
                'date' => $date,
                'start_time' => $start_time,
                'end_time' => $end_time,
            ]);
    }
}

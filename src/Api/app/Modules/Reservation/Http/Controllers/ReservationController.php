<?php

namespace App\Modules\Reservation\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Reservation\Clients\Contracts\ReservationClientInterface;
use app\Modules\Reservation\Requests\StoreReservationRequest;
use Illuminate\View\View;

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

    public function create(StoreReservationRequest $request)
    {
        // return [
        //     'userID',
        //     'api_token'

        //     'classroom',
        //     'materiaals',
        //     'user',
        //     'start_time',
        //     'end_time',
        //     'date'
        // ];
    }
}

<?php

namespace App\Modules\Reservation\Clients;

use App\Models\Reservation;
use App\Modules\Reservation\Clients\Contracts\ReservationClientInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class ReservationClient implements ReservationClientInterface
{
    function all(): Collection
    {
        return Reservation::all();
    }

    function get(string $search, string $variable): Collection
    {
        return Reservation::where($search, $variable)->get();
    }

    function getByDate(string $date, int $room_id): Collection
    {
        return Reservation::where(
            [
                'date' => $date,
                'room_id' => $room_id
        ])->get();
    }

    function create(array $variable): Reservation
    {
        return Reservation::create($variable);
    }

    function delete(string $search, string $variable): Reservation
    {
        return Reservation::where($search, $variable)->delete();
    }
}

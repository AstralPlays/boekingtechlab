<?php

namespace App\Modules\Reservation\Clients;

use App\Models\Reservation;
use App\Modules\Reservation\Clients\Contracts\ReservationClientInterface;
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

    function create(array $variable): Collection
    {
        return Reservation::create($variable);
    }

    function delete(string $search, string $variable): Collection
    {
        return Reservation::where($search, $variable)->delete();
    }
}

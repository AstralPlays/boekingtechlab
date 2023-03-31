<?php

namespace App\Modules\Reservation\Clients\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Reservation;

interface ReservationClientInterface
{
    function all(): Collection;

    function get(string $search, string $variable): Collection;

    function create(array $variable): Reservation;

    function delete(string $search, string $variable): Reservation;
}

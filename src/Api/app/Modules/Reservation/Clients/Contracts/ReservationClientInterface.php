<?php

namespace App\Modules\Reservation\Clients\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface ReservationClientInterface
{
    function all(): Collection;

    function get(string $search, string $variable): Collection;

    function create(array $variable): Collection;

    function delete(string $search, string $variable): Collection;
}

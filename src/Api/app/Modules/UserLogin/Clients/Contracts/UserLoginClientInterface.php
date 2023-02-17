<?php

namespace App\Modules\UserLogin\Clients\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface UserLoginClientInterface
{
    function all(): Collection;

    function get(string $search, string $variable): Collection;

    function create(array $variable): Collection;

    function delete(string $search, string $variable): Collection;
}

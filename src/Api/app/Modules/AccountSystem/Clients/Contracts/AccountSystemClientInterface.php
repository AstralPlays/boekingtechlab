<?php

namespace App\Modules\AccountSystem\Clients\Contracts;

use App\Models\user;
use Illuminate\Database\Eloquent\Collection;

interface AccountSystemClientInterface
{
    function all(): Collection;

    function get(string $search, string $variable): user;

    function getUser(string $email): ?user;

    function getUserByIdAndToken(int $id, string $api_token): ?user;

    function create(array $variable): user;

    function delete(string $search, string $variable): Collection;
}

<?php

namespace App\Modules\AccountSystem\Clients\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface AccountSystemClientInterface
{
    function all(): Collection;

    function get(string $search, string $variable): User;

    function getUser(string $email, string $password): bool|User;

    function getUserByIdAndToken(int $id, string $api_token): User|Collection;

    function create(array $variable): User;

    function delete(string $search, string $variable): Collection;
}

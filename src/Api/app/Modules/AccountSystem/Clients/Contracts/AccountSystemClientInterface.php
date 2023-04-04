<?php

namespace App\Modules\AccountSystem\Clients\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface AccountSystemClientInterface
{
    function all(): Collection;

    function get(string $search, string $variable): User;

    function getUser(string $email): ?User;

    function getUserByIdAndToken(int $id, string $api_token): ?User;

    function create(array $variable): User;

    function delete(string $search, string $variable): Collection;
}

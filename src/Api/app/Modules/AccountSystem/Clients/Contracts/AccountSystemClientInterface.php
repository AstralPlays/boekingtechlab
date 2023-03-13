<?php

namespace App\Modules\AccountSystem\Clients\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface AccountSystemClientInterface
{
    function all(): Collection;

    function get(string $search, string $variable): User;

    function getUser(string $email, string $password): ?User;

    function getUserByIdAndToken(int $id, string $api_token): ?User;

    function getUserByApiToken(string $id, string $api_token): bool;

    function create(array $variable): User;

    function delete(string $search, string $variable): Collection;
}

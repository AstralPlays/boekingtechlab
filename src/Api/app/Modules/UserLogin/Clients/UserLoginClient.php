<?php

namespace App\Modules\UserLogin\Clients;

use App\Models\User;
use App\Modules\UserLogin\Clients\Contracts\UserLoginClientInterface;
use Illuminate\Database\Eloquent\Collection;

class UserLoginClient implements UserLoginClientInterface
{
    function all(): Collection
    {
        return User::all();
    }

    function get(string $search, string $variable): Collection
    {
        return User::where($search, $variable)->get();
    }

    function create(array $variable): Collection
    {
        return User::create($variable);
    }

    function delete(string $search, string $variable): Collection
    {
        return User::where($search, $variable)->delete();
    }
}

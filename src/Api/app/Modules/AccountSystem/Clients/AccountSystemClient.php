<?php

namespace App\Modules\AccountSystem\Clients;

use App\Models\User;
use App\Modules\AccountSystem\Clients\Contracts\AccountSystemClientInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class AccountSystemClient implements AccountSystemClientInterface
{
    function all(): Collection
    {
        return User::all();
    }

    function get(string $search, string $variable): User
    {
        return User::where($search, $variable)->get();
    }

    public function getUser(string $email, string $password): bool|User
    {
        $user = User::where('email', $email)->first();
        if(!Hash::check($password, $user->password())){
            return false;
        }
        return $user;
    }

    function create(array $variable): User
    {
        return User::create($variable);
    }

    function delete(string $search, string $variable): Collection
    {
        return User::where($search, $variable)->delete();
    }
}

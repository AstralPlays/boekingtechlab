<?php

namespace App\Modules\AccountSystem\Clients\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface AccountSystemClientInterface
{
    function all(): Collection;

    function get(string $search, string $variable): User;

<<<<<<< Updated upstream
=======
    function getUser(string $email, string $password): bool|User;

>>>>>>> Stashed changes
    function create(array $variable): User;

    function delete(string $search, string $variable): Collection;
}

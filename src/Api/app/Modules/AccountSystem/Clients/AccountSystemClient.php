<?php

namespace App\Modules\AccountSystem\Clients;

use App\Models\user;
use App\Modules\AccountSystem\Clients\Contracts\AccountSystemClientInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class AccountSystemClient implements AccountSystemClientInterface
{
	function all(): Collection
	{
		return user::all();
	}

	function get(string $search, string $variable): user
	{
		return user::where($search, $variable)->get();
	}

	public function getUser(string $email): ?user
	{
		return user::where('email', $email)->first();
	}

	public function getUserByIdAndToken(int $id, string $api_token): ?user
	{
		return user::where('id', $id)->where('api_token', $api_token)->first();
	}
	function create(array $variable): user
	{
		return user::create($variable);
	}

	function delete(string $search, string $variable): Collection
	{
		return user::where($search, $variable)->delete();
	}
}

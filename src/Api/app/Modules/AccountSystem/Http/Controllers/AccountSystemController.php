<?php

namespace App\Modules\AccountSystem\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\AccountSystem\Clients\Contracts\AccountSystemClientInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use \Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response as Response;
use Illuminate\Routing\Route;
use Stringable;

class AccountSystemController extends Controller
{
	public function __construct(
		private AccountSystemClientInterface $userLoginClient
	) {
	}

	public function index(): Collection
	{
		return $this->userLoginClient->all();
	}

	public function register(Request $request)
	{
		$uuid = Str::uuid()->toString();
		$user = $this->userLoginClient->create(
			[
				'name' => $request['name'],
				'phone_number' => $request['phone_number'],
				'email' => $request['email'],
				'password' => Hash::make($request['password']),
				'api_token' => $uuid
			]
		);
		session()->put('user_id', $user['id']);
		session()->put('api_token', $user['api_token']);
		session()->put('role', $user['role']);
		return Response(json_encode('success'), 200);
	}

	public function login(Request $request): Route|Response
	{
		if (!$user = $this->userLoginClient->getUser($request['email'])) {
			return Response(json_encode('Unauthorized | Invalid Email'), 401);
		}
		if (!Hash::check($request['password'], $user->password())) {
			return Response(json_encode('Unauthorized | Invalid Password'), 401);
		}

		session()->put('user_id', $user['id']);
		session()->put('api_token', $user['api_token']);
		session()->put('role', $user['role']);
		return Response(json_encode('success'), 200);
	}

	public function logout()
	{
		session()->flush();
		return redirect('/login');
	}

	public function changePassword(Request $request)
	{
		if (!$request['old_password'] || !$request['new_password'] || !$request['confirm_password']) {
			return Response(json_encode('Missing parameter'), 400);
		}
		$user = $this->userLoginClient->getUserByIdAndToken(session()->get('user_id'), session()->get('api_token'));
		if (!$user) {
			return Response(json_encode('Unauthorized'), 401);
		}
		if (!Hash::check($request['old_password'], $user->password())) {
			return Response(json_encode('Unauthorized | Invalid Old Password'), 401);
		}
		if ($request['new_password'] != $request['confirm_password']) {
			return Response(json_encode('Password does not match'), 401);
		}
		$user->password = Hash::make($request['new_password']);
		$user->save();
		return Response(json_encode('success'), 200);
	}

	public function auth(Request $request): Response
	{
		$result = $this->userLoginClient->getUserByIdAndToken($request['user_id'], $request->bearerToken());
		return Response(
			[
				'auth' => 'Authorized',
				'role' => $result['role'],
			],
			200
		);
	}
}

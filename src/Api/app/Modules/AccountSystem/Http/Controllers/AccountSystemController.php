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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
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
		if (!$user) {
			return Response(json_encode('Failed to register'), 400);
		}
		return Response(json_encode('success'), 200);
	}

	public function login(Request $request): Response
	{
		$credentials = $request->only('email', 'password');

		if (Auth::attempt($credentials)) {
			return Response(json_encode('success'), 200);
		} else {
			return Response(json_encode('Unauthorized | Invalid Password'), 401);
		}
	}

	public function logout()
	{
		Auth::logout();

		session()->invalidate();
		session()->regenerateToken();

		return redirect('/login');
	}

	public function changePassword(Request $request)
	{
		/* validation rules */
		$validator = Validator::make($request->all(), [
			'old_password' => 'required',
			'new_password' => 'required|min:8',
			'confirm_password' => 'required|same:new_password',
		]);

		/* validate the values */
		try {
			$validator->validate();
		} catch (ValidationException $exception) {
			// return errors
			return Response(json_encode(['error' => $exception->errors()]), 400);
		}

		// check if user exist in database
		$user = $this->userLoginClient->getUserByIdAndToken(Auth::user()->id, Auth::user()->api_token);

		$old_password = $request['old_password'];
		$new_password = $request['new_password'];

		if (!Hash::check($old_password, $user->password)) {
			return Response(json_encode('Unauthorized | Invalid Old Password'), 401);
		}

		$user->password = Hash::make($new_password);
		$user->save();

		return Response(json_encode('success'), 200);
	}
}

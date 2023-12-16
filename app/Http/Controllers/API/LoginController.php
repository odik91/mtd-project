<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
	public function login(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'email' => 'required|email',
			'password' => 'required'
		]);

		if ($validator->fails()) {
			return response()->json($validator->errors(), 401);
		}

		$user = User::where('email', $request['email'])->first();

		if (!$user || !Hash::check($request['password'], $user['password'])) {
			return response()->json([
				'message' => 'Login failed!'
			], 401);
		}

		return response()->json([
			'message' => 'Login success!',
			'data' => $user,
			'token' => $user->createToken('authToken')->accessToken
		], 200);
	}

	public function logout(Request $request)
	{
		try {
			// $request->user()->tokens()->delete();
			// Auth::user()->tokens()->delete();
			$request->user()->token()->revoke();

			return response()->json([
				'message' => 'Logout Success!',
			], 200);
		} catch (Exception $e) {
			return response()->json([
				'message' => 'Fail to logout',
				'error_log' => $e->getMessage()
			], 401);
		}
	}
}

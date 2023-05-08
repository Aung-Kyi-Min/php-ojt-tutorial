<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    //
    public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return response(['errors' => $validator->errors()->all()], 422);
    }

    $request['password'] = bcrypt($request->password);
    $user = User::create($request->toArray());
    $token = $user->createToken('token')->plainTextToken;

    return response()->json([
        'status' => 'Success',
        'message' => 'Successfully Registered...',
        'data' => $token,
    ],200);
}

public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8',
    ]);

    if ($validator->fails()) {
        return response(['errors' => $validator->errors()->all()], 422);
    }

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response(['error' => 'The provided credentials are incorrect.'], 401);
    }

    $token = $user->createToken('token')->plainTextToken;

    return response()->json([
        'status' => 'Success',
        'message' => 'Successfully login...',
        'data' => $token,
    ],200);
}

public function logout(Request $request)
{
    $request->user()->tokens()->delete();

    return response(['message' => 'Logged out.'], 200);
}

}

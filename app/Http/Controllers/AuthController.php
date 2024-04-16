<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\UnauthorizedException;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $Validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
        if ($Validator->fails()) {
            return response()->Json($Validator->errors()->tojson(), 400);
        }
        $user = user::create(array_merge(
            $Validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        return response()->Json([
            'message' => 'user succesfully registered',
            'user' => $user

        ], 201);
    }
    public function login(Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|exists:users',
            'password' => 'required|string|min:8',
        ]);
        if ($Validator->fails()) {
            return response()->Json($Validator->errors()->tojson(), 422);
        }
        if (!$token = auth()->attempt($Validator->validated())) {
            return response()->Json(['error' => 'unauthorized'], 401);
        }
            $user = User::where('email', $request->email)->first();
            $token = $user->createtoken('auth-token')->plainTextToken;
            return response()->Json(['token'=>$token]);
        
    }
}

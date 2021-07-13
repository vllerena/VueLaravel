<?php

namespace App\Http\Controllers;

use App\Models\Info\UserAttr;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['login', 'signup']]);
    }

    public function login(Request $request)
    {
        $validateData = $request->validate([
           'username' => 'required',
           'password' => 'required',
        ]);

        $credentials = request(['username', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'User or Password not found, please type an correct user or password'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
{
    auth()->logout();

    return response()->json(['message' => 'Successfully logged out']);
}

    public function signup(Request $request)
    {
        $validate = $request->validate([
            UserAttr::DATOS_PERSONALES => 'required',
            UserAttr::USERNAME => 'required | unique:usuarios',
            UserAttr::PASSWORD => 'required | min:6',
        ]);

        User::create([
            UserAttr::DATOS_PERSONALES => $request->datos_personales,
            UserAttr::USERNAME => $request->username,
            UserAttr::PASSWORD => Hash::make($request->password),
        ]);

        return $this->login($request);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'name' => auth()->user()->datos_personales,
            'user_id' => auth()->user()->id,
            'dni' => auth()->user()->dni,
        ]);
    }
}

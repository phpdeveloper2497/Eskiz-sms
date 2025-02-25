<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\MeResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{


    public function login(LoginRequest $request): MeResource
    {
        $user = User::where('name', $request->name)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'name' => __('auth.failed'),
            ]);
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        return (new MeResource($user))->additional([
            'token' => $token,
            'message' => __('Auth successfully'),
        ]);
    }

    public function me(Request $request)
    {
      $user =  $request->user('sanctum');
      return (new MeResource($user));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserApplicationResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function store(UserStoreRequest $request)
    {
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "password" => Hash::make($request->password),
        ]);

    return response()->json(["message" => "User created successfully"], 201);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated());
        return new UserResource($user);

    }

    public function userApplications(User $user)
    {
        return new UserApplicationResource($user);
    }
}


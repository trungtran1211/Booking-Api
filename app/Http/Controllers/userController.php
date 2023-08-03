<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Http\JsonResponse;

class userController extends Controller
{
    public function register(Request $request)
    {
        $userData = $request->only(['name', 'email', 'password', 'role_id']);

        $user = User::create($userData);

        $role = Roles::find($userData['role_id']);

        $user->roles()->attach($role);

        return response()->json(['message' => 'User created successfully', 'user' => $user], 200);
    }
}

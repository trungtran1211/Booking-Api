<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        $userData = $validator->validated();
    
        $userData['password'] = Hash::make($userData['password']);

        $role = Roles::find($userData['role_id']);

        if (!$role) {
            return response()->json(['errors' => ['role_id' => ['The selected role does not exist.']]], 400);
        }
    
        $user = User::create($userData);
        
        $user->roles()->attach($role);
    
        return response()->json(['message' => 'User created successfully', 'user' => $user], 200);
    
    }
}

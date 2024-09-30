<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate token for the new user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return user and token in response
        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function logout()
    {
        // Delete the current token being used
        auth()->user()->tokens()->delete();
    
        return response()->json([
            'message' => 'Successfully logged out!',
        ], 200);
    }

    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

       $user= User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response([
                'message' => 'The provided credentials are incorrect.'
            ], 401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return user and token in response
        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);

    }
    
    
}

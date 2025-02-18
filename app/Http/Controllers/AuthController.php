<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
// use Illuminate\Http\Response;
// use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller
{
    public function register(Request $request){
        // validate the input 
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        // create a new user 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),
        ]);

        // incase if registration failed 
        if(!$user){
            return response()->json([
                'message' => 'Registration failed'
            ], 400);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'Registration successful',
            'token' => $token,
        ],200);
    }

    
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(!Auth::attempt($credentials)){
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = $request->user();
        return response()->json([
            'message' => 'Login successful',
            'token' => $user->createToken('auth_token')->plainTextToken,
        ],200);
    }
    public function logout(Request $request){
        if($request->user()){
            $request->user()->currentAccessToken()->delete();
        }
        Auth::logout();
        return response()->json([
            'message' => 'Logout successful',
        ],200);

    }
}

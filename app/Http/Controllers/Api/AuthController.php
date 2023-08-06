<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'device_name' => 'string|max:255',
        ]);

        if (User::where('email', $request->email)->exists()) {
            return response()->json([
                'code' => 0,
                'message' => 'Email already exists'
            ], 401);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        $device_name = $request->post('device_name', $request->userAgent());
        $token = $user->createToken($device_name);



        return response()->json([
            'code' => 1,
            'message' => 'Registration Successful',
            'access_token' => $token->plainTextToken,
            'user' => $user
        ], 201);
    }



    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
            'device_name' => 'string|max:255',
        ]);

        $user = User::where('email', $request->email)->first();

        // Check if the user exists and the provided password is correct
        if ($user && Hash::check($request->password, $user->password)) {

            // Check if the email is verified

                $device_name = $request->post('device_name', $request->userAgent());
                $token = $user->createToken($device_name);

                return Response::json([
                    'code' => 1,
                    'message' => 'You have logged in',
                    'access_token' => $token->plainTextToken,
                    'user' => $user
                ], 201);

                // If email is not verified, return an error response


        }

        // If user authentication fails, return an error response
        return Response::json([
            'code' => 0,
            'message' => 'Invalid Credentials',
            'access_token' => null,
            'user' => null,
        ], 401);
    }




    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'code' => 1,
            'message' => 'Tokens revoked',
            'access_token' => null,
            'user' => null,

        ]);
    }


}


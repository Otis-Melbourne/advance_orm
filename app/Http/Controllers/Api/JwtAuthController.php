<?php

namespace App\Http\Controllers\Api;

use App\Events\RegistrationEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Mail\RegistrationMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class JwtAuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => "required|string|max:255",
            'email' => "required|string|email|max:255|unique:users,email",
            'password' => "required|string|max:16|min:6",
        ] );

        if($validator->fails()){
            return response()->json([
                'statusCode' => 400,
                'message' => $validator->errors(),
            ], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('user');
        $token = JWTAuth::fromUser($user);

        RegistrationEvent::dispatch($user);

        return response()->json([
            'statusCode' => 201,
            'message' => 'User created successfully',
            'data' => [
                'user' => new UserResource($user),
                'token' => $token,
            ],
        ], 201);

    }
}

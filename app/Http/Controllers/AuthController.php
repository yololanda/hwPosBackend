<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|unique:users,name',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed', // confirm will require you to add ** password_confirmation ** on postman
            'role' => 'required|string'
        ]);
        $role = '' . $fields['role'];
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'role' => $role
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }


    public function login(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string' // confirm will require you to add password_confirmation on postman
        ]);

        // check email
        $user = User::where('name', $fields['name'])->first();

        // check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => "No entry"
            ], 401);
        }

        // link token to user email
        $token = $user->createToken($fields['name'])->plainTextToken;

        if ($user->name == 'admin') {

            $response = [
                'user' => $user,
                'token' => $token,
                'secret' => '310394'
            ];

        } else {
            $response = [
                'user' => $user,
                'token' => $token,
                'secret' => '0'
            ];
        }

        return response($response, 201);
    }

    // delete token when logout, post bearer token
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged Out'
        ];
    }
}

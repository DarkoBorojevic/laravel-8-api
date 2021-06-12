<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

// login credentials
// name: Superadmin
// email: superadmin@name.com
// password: admin12345

class AuthenticationController extends Controller
{
    
    // Register users
    public function register(Request $request) {

        $fields = $request->validate([

            'name'      => 'required|string|regex:/^[a-zA-Z]+$/|min:2|max:255',
            'email'     => 'required|string|unique:users,email',
            'password'  => 'required|string|confirmed'

        ]);

        $user = User::create([

            'name'      => $fields['name'],
            'email'     => $fields['email'],
            'password'  => bcrypt($fields['password'])

        ]);

        $token = $user->createToken('myToken')->plainTextToken;

        $response = [

            'user'  => $user,
            'token' => $token 

        ];

        return response($response, 201);

    }

    // Login a user
    public function login(Request $request) {

        $fields = $request->validate([

            'email'     => 'required|string',
            'password'  => 'required|string'

        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            
            return response([

                'message' => 'Bad credentials!'

            ], 401);

        }

        $token = $user->createToken('myToken')->plainTextToken;

        $response = [

            'user'  => $user,
            'token' => $token 

        ];

        return response($response, 201);

    }

    // Logout a user
    public function logout(Request $request) {

        auth()->user()->tokens()->delete();

        return [

            'message' => 'You are logged out!'

        ];

    }

}

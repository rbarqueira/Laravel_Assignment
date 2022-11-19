<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserAPIController extends Controller
{

    // Create New User
    public function store(Request $request) {

        $formFields = Validator::make($request->all(),
        [
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|min:6'
        ]);

        
        if($formFields->fails()){
            return response()->json([
                'status' => false,
                'message' => "validation error",
            ], 401);
        }

        // Create User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]
        );

        return response()->json([
            'status' => true,
            'message' => "User Created successfully!",
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ], 200);
    }

    // Logout User
    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => "User Logged Out successfully!",
        ], 200);

    }

    // Authenticate User
    public function authenticate(Request $request) {

        $formFields = Validator::make($request->all(),
        [
            'email' => 'required|email',
            'password' => 'required|'
        ]);

        
        if($formFields->fails()){
            return response()->json([
                'status' => false,
                'message' => "validation error",
            ], 401);
        }

        if(Auth::attempt($request->only(['email','password']))) {

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => "User Logged In successfully!",
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => "Incorrect User Credentials",
        ], 401);
    }
}

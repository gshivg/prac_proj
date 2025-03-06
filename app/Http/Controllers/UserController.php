<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|unique:users|email',
            'password' => 'required|string',
            'c_password' => 'required|same:password'
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if ($user->save()) {
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;

            return response()->json([
                'message' => 'Success',
                'accessToken' => $token,
            ]);
        } else {
            return response(null, 400)->json(['error' => 'server-error']);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorised'
            ], 401);
        }


        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;

        return response()->json([
            'accessToken' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        if (is_null($user)) {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }

        $user->name = is_null($request->name) ? $user->name : $request->name;
        $user->email = is_null($request->email) ? $user->email : $request->email;

        $user->save();

        return response()->json([
            "message" => "User Updated"
        ], 200);
    }

    public function destroy(Request $request)
    {
        $user = $request->user();

        if (is_null($user)) {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }

        $userModel = User::find($user->id);
        $userModel->delete();

        return response()->json([
            "message" => "User deleted"
        ], 202);
    }
}

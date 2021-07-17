<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, User::$rules);
        $createUser = [
            'id' => $request->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];
        $item = User::create($createUser);
        return response()->json([
            'data' => $item
        ], 200);
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if ($user) {
            return response()->json([
                'data' => $user
            ], 200);
        } else {
            return response()->json([
                'message' => 'ユーザーが見当たりません'
            ], 404);
        }
    }
}

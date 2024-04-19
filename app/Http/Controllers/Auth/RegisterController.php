<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request)
        {
            try{
                $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|unique:users|max:255',
                    'password' => 'required|string|min:8|confirmed',
                ]);
            }catch (\Exception $e) {
                return response()->json(['message' => 'User registration failed', 'error' => $e->getMessage()], 500);
            }


            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($user) {
                return response()->json(['message' => 'User registered successfully', 'user' => $user]);
            } else {
                return response()->json(['message' => 'User registration failed'], 500);
            }
        }

}



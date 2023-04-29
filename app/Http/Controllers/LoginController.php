<?php

namespace App\Http\Controllers;

use App\Business\AbilitiesResolver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        $user = User::where('email', request('email'))
            ->first();

        if ($user && Hash::check(request('password'), $user->password)) {

            // Eliminar todos los tokens existentes del usuario
            // $user->tokens()->delete();

            $abilities = AbilitiesResolver::resolve($user, request('device'));
          
            // Asigancion de token al usuario
            $token = $user->createToken('login', $abilities);

            return [
                'token' => $token->plainTextToken
            ];
        }

        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }
}

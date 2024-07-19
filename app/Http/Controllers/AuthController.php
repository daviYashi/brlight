<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
    
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
    
        return $user;
    }

    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $user = User::where('email', $request->input('email'))->first();
    
        if (! $user || ! Hash::check($request->input('password'), $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email incorreto ou não existente.'],
            ]);
        }
    
        return $user->createToken('token')->plainTextToken;
    }

    public function logout(Request $request){

        $user = $request->user('sanctum');

        if(!$user){
            return response()->json(['message' => 'Usuário não encontrado.'], 404);
        }

        $user->tokens()->delete();

        return response()->json('Logout efetuado com sucesso', 200);
    }
}

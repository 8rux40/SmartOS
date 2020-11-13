<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutenticadorController extends Controller
{
    public function registro(Request $request){
        //nome email senha
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|unique:users',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|'
        ]);

        $user = new User(['name'=> $request->name, 'username'=> $request->username, 'email'=> $request->email, 'password'=> bcrypt($request->password)]);
        $user->save();
        return response()->json(['response'=> 'Usuário criado com sucesso!'], 201);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|'
        ]);
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(!Auth::attempt($credentials)){
            return response()->json(['response'=> 'Acesso negado'],401);
        }

        $user = $request->user();
        $token = $user->createToken('authToken')->accessToken;

        return response()->json(['token'=>$token],200);
    }

    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json(['response' => 'You logged out']);
    }
}

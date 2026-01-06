<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'password'=> 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah'
            ], 401);
        }
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'login berhasil',
            'token' => $token,
            'user' => $user
        ], 200);
    }
    
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success'=>true,
            'message'=>'logout berhasil'
        ]);
    }
    public function me(Request $request){
        return response()->json([
            'success' => true,
            'user' => $request->user()->load('pegawai')
        ], 200);
    }


    public function register(Request $request){
       $data = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'password'=>'required|min:6'
       ]);

       $data['password'] = Hash::make($data['password']);
       $user = User::create($data);

       return response()->json([
        'success' => true,
        'message' => 'user berhasil dibuat',
        'user' => $user
       ], 201);
    }

    public function index(){
        return response()->json([
            'success' => true,
            'users' => User::with('pegawai')->get()
        ]);
    }
}

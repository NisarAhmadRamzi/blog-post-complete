<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request){
        $user = User::where('email',$request->email)->first();
        $token = $user->createToken($user->name)->plainTextToken;
        
        if(! $user || ! Hash::check($request->password,$user->password)){
                return "User password or email is inccorect!!!";
            }
            
        $data = [
            'user'=>$user,
            'token'=>$token
        ];
        return $data;
    }

    public function register(RegisterRequest $request){
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'user_role'=>1,
        ]);

        $data = [
            'user' => $user,
            'token' => $user->createToken($user->name)->plainTextToken
        ];

        return $data;
    }


    public function logout(Request $request){
        $user=$request->user();
        $user->tokens()->delete();

        return "user logouted!!!";
    }



    // public function register(RegisterRequest $request)
    // {
    //     // Register user without requiring authorization first
    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password),
    //         'user_role' => '1',  // Ensure this column exists and is correct
    //     ]);

    //     // Now, create the token for the registered user
    //     $data = [
    //         'user' => $user,
    //         'token' => $user->createToken($user->name)->plainTextToken
    //     ];

    //     return response()->json($data, 201);
    // }


    
                
    // public function register(Request $request){
    //     $fields = $request->validate([
    //         'name'=>'required',
    //         'email'=> 'required|email|unique:users',
    //         'password'=> 'required|confirmed',
    //         'user_role'=>'nullable',
    //     ]);
        
    //     $user = User::create([
    //             'name'=>$request->name,
    //             'email'=>$request->email,
    //             'password'=>bcrypt($request->password),
    //             'user_role'=>2,
    //     ]);
    //     $token = $user->createToken($request->name);
    //     return [
    //         'user'=>$user,
    //         'token'=>$token->plainTextToken
    //     ];
    // }
}

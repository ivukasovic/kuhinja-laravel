<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $userValidator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email|unique:users',
            'password'=>'required|string|min:6',
        ]);

        if($userValidator->fails())
            return response()->json($userValidator->errors());

        $user=\App\Models\User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),

        ]);

        $token=$user->createToken('auth_token')->plainTextToken;
        return response()->json(['data'=>$user, 'access_token'=>$token, 'token_type'=>'Bearer']);
    }


    public function login(Request $request)
    {
        if(!Auth::attempt($request->only('email','password')))
            return response()->json(['message'=>'Unauthorized'],401);

        $user=\App\Models\User::where('email',$request['email'])->firstOrFail();
        $token=$user->createToken('auth_token')->plainTextToken;

        return response()->json(['message'=>'Welcome'.$user->name,'access_token'=>$token,'token_type'=>'Bearer']);
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();
        return[
            'message'=>'Logout successful'
        ] ;
    }
}
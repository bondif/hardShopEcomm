<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\User;
use Illuminate\Support\Facades\Hash;

class RestUserController extends Controller
{
    public function signUp(Request $request){
        $this->validate($request, [
            'fName' => 'required|max:30',
            'lName' => 'required|max:30',
            'email' =>'required|email|max:50',
            'username' => 'required|max:50|unique:customers,username',
            'password' => 'required|max:60',
            'tel' => 'max:30',
            'address' => 'max:50'
        ]);

        $user = User::create([
            'fName' => $request->input('fName'),
            'lName' => $request->input('lName'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'tel' => $request->input('tel'),
            'address' => $request->input('address'),
        ]);

        if($user)
            return response()->json([
                'msg' => 'User Created Successfully',
                'token' => $token = JWTAuth::fromUser($user)
            ], 200);

        return response()->json(['msg' => 'Something went wrong please try again'], 500);
    }

    public function login(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');

        //dd($credentials);
        try {
            if(! $token = JWTAuth::attempt($credentials)){
                return response()->json(['msg' => 'Invalid Username or Password'], 401);
            }
        } catch (JWTException $e){
            return response()->json(['msg' => 'Could not create token'], 500);
        }

        return response()->json(compact('token'), 200);
    }

    public function checkout(Request $request){
        return 'It Works!';
    }

    public function update(Request $request, $id)
    {
        $fName = $request->input('fName');
        $lName = $request->input('lName');
        $email = $request->input('email');
        $tel = $request->input('tel');
        $address = $request->input('address');
        $username = $request->input('username');
        $password = $request->input('password');
        return 'It Works!';
    }
}

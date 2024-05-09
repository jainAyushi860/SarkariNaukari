<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
class AuthController extends Controller
{
     public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }
   

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user = Auth::user();

            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $sucess['name'] = $user->name;
            return response()->json([
                'success' => true,
                'data' => $success,
                'message' => 'Login successful',
                'token' => $token
            ]);
        } else {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }
     }
}

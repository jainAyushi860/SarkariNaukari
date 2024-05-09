<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z- ]*$/|string|min:2|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            // 'mobile' => 'required|regex:/^[0-9]{10}+$/',
            // 'dob' => 'required|regex:/^(\d{4})-(\d{2})-(\d{2})$/',
            // 'gender' => 'required|in:Male,Female,Other,male,female,other',
            'password' => 'required|string|min:6|max:8|confirmed',
          ]);
            
                // If validation fails, return a JSON response with validation errors
                if ($validator->fails()) {
                    return response()->json(['message' => $validator->errors()], 400);
                }

              $user =  User::create([
               'name'=> $request->name,
               'email'=> $request->email,
               'password'=> Hash::make($request->password)
              ]);
              return response()->json([
                'status' => 1,
                'message'=> 'User registered successfully',
                'user'=> $user
              ]);
        
    }


    //For login

    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6|max:8',
          ]);
            
                if ($validator->fails()) {
                    return response()->json(['message' => $validator->errors()], 400);
                }
            
                if(!$token = auth()->attempt($validator->validated())){
                   return response()->json(['error'=>'unauthorized']);
                }

                return $this->token($token);
    }

    protected function token($token){
        return response()->json([
          'access_token'=> $token,
          'token_type'=> 'bearer',
          'expires_in' => auth()->factory()->getTTL()*60
        ]);
    }


    public function profile(){
        return response()->json(auth()->user());
    }

    
    public function logout(){

        auth()->logout();
        return response()->json(['message' => 'User Successfully Logged Out']);
    }
}

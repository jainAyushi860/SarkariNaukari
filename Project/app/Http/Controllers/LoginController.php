<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use App\Models\Signup;
use App\Models\OtpGeneration;
use Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{ 

    public function store(Request $request){
          // Validate the incoming request data
          $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z- ]*$/',
            'email' => 'required|email|max:100|unique:signup',
            'mobile' => 'required|regex:/^[0-9]{10}+$/',
            'dob' => 'required|regex:/^(\d{4})-(\d{2})-(\d{2})$/',
            'gender' => 'required|in:Male,Female,Other,male,female,other',
            'password' => 'required|string|min:6|max:8|confirmed',
            // 'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/',
    //       ],
    //        [
    // 'name.required' => 'The name field is required.',
    // 'name.regex' => 'The name field must contain only letters, hyphens, and spaces.',
    // 'email.required' => 'The email field is required.',
    // 'email.email' => 'Please enter a valid email address.',
    // 'mobile.required' => 'The mobile field is required.',
    // 'mobile.regex' => 'The mobile field must be exactly 10 digits long and contain only numbers.',
    // 'dob.required' => 'The date of birth field is required.',
    // 'dob.regex' => 'The date of birth must be in the format YYYY-MM-DD.',
    // 'gender.required' => 'The gender field is required.',
    // 'gender.in' => 'Please select a valid gender.',
    // 'password.required' => 'The password field is required.',
    // 'password.regex' => 'The password must contain at least 1 lowercase letter, 1 uppercase letter, 1 digit, 1 special character, and be at least 8 characters long.',

   ]);
    
        // If validation fails, return a JSON response with validation errors
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }

        $user =  Signup::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'mobile' => $request->mobile,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'password'=> Hash::make($request->password),
            'status' => 'Active',
           ]);
           return response()->json([
             'status' => 1,
             'message'=> 'User registered successfully',
             'user'=> $user
           ]);

//        // Check if the email already exists
//         $email = $request->email; 
//       $emailVerify = Signup::where('email', $email)->exists();

//           if ($emailVerify) {
//               return response()->json(['message' => 'This email is already being used']);
//             }
//           else{
//          // Insert data into the database
//       $signupData = new Signup;

//       $signupData->name = $request->name;
//       $signupData->email = $request->email;
//       $signupData->mobile = $request->mobile;
//       $signupData->dob =  $request->dob;
//       $signupData->gender = $request->gender;
//       $signupData->password = md5($request->password);
//       $signupData->status = 'Active';
//       $signupData->created_at = now();
//       $signupData->save();
  
//   // Return a JSON response indicating success
//   return response()->json(['message' => 'Data saved successfully'], 200);
//           }
    
    }

    // /// For Login
    // public function login(Request $request) {

    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email',
    //         'password' => 'required|string',
    //     ]);

    //     if ($validator->fails()) {
    //         throw ValidationException::withMessages($validator->errors()->toArray());
    //     }

    //     // $signup = Signup::getByEmailAndPassword($request->email, $request->password);

    //     $signup = Signup::where('email', $request->email)->where('password', $request->password)->first();

    //     if ($signup) {
    //         // Login successful
    //         $expirationTime = now()->addMinutes(1); // Token expires in 1 minute
    //         $token = $this->generateToken($request->email, $expirationTime);
    //         return response()->json([
    //             'message' => 'Login successful',
    //             'token' => $token
    //         ]);
    //     } else {
    //         return response()->json([
    //             'message' => 'Invalid credentials'
    //         ], 401);
    //     }
    // } 

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
                       return response()->json(['error'=>'Token is expired']);
                    }

                 // Save the token in the database

                     $user = auth()->user();
                     $user->token = $token;
                     $user->save();

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
            if (auth()->check()) {
                return response()->json(auth()->user());
            } else {
                return response()->json(['message' => 'Not Authorized'], 401);
            }
        }

        public function logout(){

            if (auth()->check()) {
                auth()->logout();
                return response()->json(['message' => 'User Successfully Logged Out']);
            } else {
                return response()->json(['message' => 'No user authenticated to log out'], 401);
            }
        }


    // public function generateToken($email, $expiryTime){
    //     // Create the payload including email and expiry time
    //     $payload = [
    //         'email' => $email,
    //         'exp' => $expiryTime->timestamp
    //     ];

    //     // Convert payload to JSON
    //     $payloadJson = json_encode($payload);

    //     // Encrypt the payload
    //     $encryptedPayload = Crypt::encryptString($payloadJson);

    //     return $encryptedPayload;
    // }

    // public function isTokenValid(Request $request)
    // {
    //     $token = $request->bearerToken();

    //     if (!$token) {
    //         return response()->json([
    //             'message' => 'Token not provided'
    //         ], 401);
    //     }

    //     try {
    //         // Decrypt the token
    //         $decryptedPayload = Crypt::decryptString($token);

    //         // Convert JSON payload back to array
    //         $payload = json_decode($decryptedPayload, true);

    //         // Check if token has expired
    //         if (isset($payload['exp']) && $payload['exp'] >= now()->timestamp) {
    //             return response()->json([
    //                 'message' => 'Token is valid',
    //                 'payload' => $payload
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'message' => 'Token is expired'
    //             ], 401);
    //         }
    //     } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
    //         return response()->json([
    //             'message' => 'Invalid token'
    //         ], 401);
    //     }
    
    // }


    /// For OTP generation and forgot password
    public function generateOTP(Request $request){

        $validator = Validator::make($request->all(), [
              'email' => 'required|email',
          ]);
       
          if ($validator->fails()) {
              return response()->json(['message' => $validator->errors()], 422);
          }
  
          $email = $request->email;
          $signup = Signup::where('email', $email)->first();
  
          if (!$signup) {
              return response()->json([
                  'message' => 'This email is not registered'
              ], 404);
          }
  
          $clientId = $signup->id;
  
          $otp = rand(100000, 999999); // Generates random OTP
  
          $existingOtp = OtpGeneration::where('email', $email)->first();
  
          if ($existingOtp) {
              return response()->json([
                  'message' => 'An OTP has already been sent to this email'
              ], 400);
          }else{


            $generateOtp = new OtpGeneration;

            $generateOtp->email = $request->email;
            $generateOtp->otp = $otp;
            $generateOtp->client_id  = $clientId;
            $generateOtp->created_at = now();
            $generateOtp->save();
 
   return response()->json(['message' => 'OTP generated successfully']);
          }  
       }



            /// For Otp Verification

  public function OTPverification(Request $request){

    $validator = Validator::make($request->all(), [
              'email' => 'required|email',
              'otp' => 'required',
         ]);
      
         if ($validator->fails()) {
             return response()->json(['message' => $validator->errors()], 422);
         }
 
         $email = $request->email;
         $otp = $request->otp;
 
         $verification = OtpGeneration::where('email', $email)
             ->where('otp', $otp)
             ->where('created_at','>=',"now() - interval 100 minute")
             ->first();
 
         if ($verification) {
             return response()->json([
                 'message' => 'Verified OTP'
             ]);
         } else {
             return response()->json([
                 'message' => 'Please enter a valid OTP'
             ], 400);
         }
     }
  
       ///For Reset Password
    public function passwordReset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:8|confirmed',
       ]);
    
       if ($validator->fails()) {
           return response()->json(['message' => $validator->errors()], 422);
       }

       $email = $request->email;
       $password = $request->password;
  

        $signup = Signup::where('email', $email)->first();

        if ($signup) {
            // Check if the new password is different from the current one
            if (!Hash::check($password, $signup->password)) {
                $updateData = Signup::where('email', $email)->update([
                    'password' => Hash::make($password),
                ]);
    
                if ($updateData) {
                    return response()->json([
                        'message' => 'Password updated successfully'
                    ]);
                } else {
                    return response()->json([
                        'message' => 'Failed to update password'
                    ], 500);
                }
            } else {
                return response()->json([
                    'message' => 'Password is already updated'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Please enter a valid email'
            ], 404);
        }
    }

    ///For Delete Record

    public function deleteRecord(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
       ]);
    
       if ($validator->fails()) {
           return response()->json(['message' => $validator->errors()], 422);
       }

       $email = $request->email;

        $signup = Signup::where('email', $email)->first();

        if ($signup) {
            $clientId = $signup->id;

            $deletedRows = Signup::where('id', $clientId)->delete();
            OtpGeneration::where('client_id', $clientId)->delete();

            if ($deletedRows > 0) {
                return response()->json([
                    'message' => 'Record deleted successfully'
                ]);
            } else {
                return response()->json([
                    'message' => 'Failed to delete record'
                ], 500);
            }
        } else {
            return response()->json([
                'message' => 'Given email does not exist'
            ], 404);
        }
    }
}

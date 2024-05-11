<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Models\Signup;
use App\Models\OtpGeneration;
use Auth;
use Mail;
use App\Mail\smtpemail;
use Exception;
use Twilio\Rest\Client;
use Anhskohbo\NoCaptcha\Facades\NoCaptcha;
use Laravel\Socialite\Facades\Socialite;

use Tymon\JWTAuth\Facades\JWTAuth;
//use App\jobs\CleanupExpiredOtps;

class LoginController extends Controller
{ 

    /// for google captcha
       public function getuser(){
        return view('google');
     }
     

     // For Registration
     public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z- ]*$/', 
            'email' => 'required|email|max:100|unique:signup',
            'mobile' => 'required|regex:/^\+91\s\d{5}\s\d{5}$/',
            'dob' => 'required|regex:/^(\d{4})-(\d{2})-(\d{2})$/',
            'gender' => 'required|in:Male,Female,Other,male,female,other',
            'password' => 'required|string|min:6|max:8',
            'g-recaptcha-response' => 'required|captcha',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }
        
        // $request->validate([
        //     'name' => 'required|regex:/^[a-zA-Z- ]*$/',
        //     'email' => 'required|email|max:100|unique:signup',
        //     'mobile' => 'required|regex:/^\+91\s\d{5}\s\d{5}$/',
        //     'dob' => 'required|regex:/^(\d{4})-(\d{2})-(\d{2})$/',
        //     'gender' => 'required|in:Male,Female,Other,male,female,other',
        //     'password' => 'required|string|min:6|max:8',
        //     'g-recaptcha-response' => 'required|captcha',
        // ]);
    
        $user = Signup::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'mobile'=> $request->mobile,
            'dob'=> $request->dob,
            'gender'=> $request->gender,
            'password'=> Hash::make($request->password),
            'status'=> 'Active',
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
            //    'g-recaptcha-response' => 'required|captcha',
            ]);
                
                    if ($validator->fails()) {
                        return response()->json(['message' => $validator->errors()], 400);
                    }
                
                    if(!$token =  Auth::attempt($validator->validated())){
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
              'expires_in' => auth()->factory()->getTTL()*3660
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

/// for google login

    public function googleLogin(){
        return Socialite::driver('google')->redirect();
     }

     public function googleHandle(){
        try{
      $userlogin = Socialite::driver('google')->user();

      $findUser = Signup::where('email',$userlogin->getEmail())->first();

      if(!$findUser){

    $saveuser = Signup::updateOrCreate([
        'google_id' => $userlogin->getId(),
    ],[
            'name' => $userlogin->getName(),
            'email' => $userlogin->getEmail(),
            'password' => Hash::make($userlogin->getName().'@'.$userlogin->getId()),
            'status' => 'Active',
            'token'=> $userlogin->token
    ]);

    Auth::login($saveuser);
    return redirect('/home');
  
      }
      else{

        $saveuser = Signup::where('email',$userlogin->getEmail())->update([
            'google_id' => $userlogin->getId(),
        ]);
        $saveuser = Signup::where('email',$userlogin->getEmail())->first();  
      
       }

      Auth::login($findUser);
      return redirect('/home');

      } catch(Exception $e){
            dd($e->getMessage());
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
      //otp send by email
    public function generateOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }
    
        $email = $request->email;
        $signup = Signup::where('email', $email)->first();
    
        if (!$signup) {
            return response()->json(['message' => 'This email is not registered'], 404);
        }
    
        $clientId = $signup->id;
    
        // Generate OTP
        $otp = rand(1000, 9999);     

        $email = $request->email;
        $otpData = OtpGeneration::where('email', $email)->first();
        
        if ($otpData) {
            $otpData->email_otp = $otp; // Update the OTP
            $otpData->created_at = now(); // Update the creation timestamp if needed
            $otpData->save(); // Save the changes
        } else{
 // Save OTP in the database

             $otpData = new OtpGeneration;
             $otpData->email = $email;
             $otpData->email_otp = $otp;
             $otpData->client_id = $clientId;
             $otpData->created_at = now();
             $otpData->save();
        }

        $sender = getenv('MAIL_USERNAME');
      // Send OTP via email
        $mailData = [
            'title' => 'Mail from' . $sender,
            'body' => 'Your One Time Password Is ' . $otp
        ];
    
        Mail::to($email)->send(new smtpemail($mailData));
    
        return response()->json(['message' => 'OTP generated and sent successfully']);
    }


    
    /// For OTP generation and forgot password

    //otp send by sms 
    public function sendOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|regex:/^\+91\s\d{5}\s\d{5}$/',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }
    
        $reciever_phone = $request->mobile_number;
        $signup = Signup::where('mobile', $reciever_phone)->first();
    
        if (!$signup) {
            return response()->json(['message' => 'This Phone number is not registered'], 404);
        }
    
        $clientId = $signup->id;
    
        // Generate OTP
        $otp = rand(1000, 9999);    

        $reciever_phone = $request->mobile_number;
        $otpData = OtpGeneration::where('mobile_number', $reciever_phone)->first();
        
        if ($otpData) {
            $otpData->mobile_otp = $otp; // Update the OTP
            $otpData->created_at = now(); // Update the creation timestamp if needed
            $otpData->save(); // Save the changes
        } else{
 // Save OTP in the database

             $otpData = new OtpGeneration;
             $otpData->mobile_number = $reciever_phone;
             $otpData->mobile_otp = $otp;
             $otpData->client_id = $clientId;
             $otpData->created_at = now();
             $otpData->save();
        }

        
    
        // Send OTP via sms
        $reciever_phone = $request->mobile_number;
        $body = 'Your One Time Password Is ' . $otp;


try{
        $sid    = getenv("TWILIO_SID");
        $token  = getenv("TWILIO_AUTH_TOKEN");
        $sendernumber  = getenv("TWILIO_PHONE_NUMBER");

        $client = new Client($sid, $token);
        $message = $client->messages->create($reciever_phone,[
              "from" => $sendernumber,
              "body" => $body
            ]);

          dd("message send successfully");
          return $message->sid;
        // return response()->json(['message' => 'OTP sent successfully']);
          }
          catch (Exception $e){
            dd("Error:". $e);
          }
     
    }


            /// For Otp Verification
// by email
  public function OTPverificationEmail(Request $request){

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
             ->where('email_otp', $otp)
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


     //by mobile number
  public function OTPverificationSms(Request $request){

    $validator = Validator::make($request->all(), [
        'mobile_number' => 'required|regex:/^\+91\s\d{5}\s\d{5}$/',
              'otp' => 'required',
         ]);
      
         if ($validator->fails()) {
             return response()->json(['message' => $validator->errors()], 422);
         }
 
         $mobile = $request->mobile_number;
         $mobileOtp = $request->otp;
 
         $verification = OtpGeneration::where('mobile_number', $mobile)
             ->where('mobile_otp', $mobileOtp)
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
